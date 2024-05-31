<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('association_id');
            $table->string('name');
            $table->string('species_id');
            $table->string('race_id');
            $table->string('age');
            $table->boolean('available');
            $table->timestamps();

            $table->foreign('association_id')->references('id')->on('associations');
            $table->foreign('species_id')->references('id')->on('animal_species');
            $table->foreign('race_id')->references('id')->on('animal_races');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
