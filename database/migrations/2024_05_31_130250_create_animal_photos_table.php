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
        Schema::create('animal_photos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('animal_id');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_extension');
            $table->string('file_mime_type');
            $table->string('url');

            $table->timestamps();

            $table->foreign('animal_id')->references('id')->on('animals');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_photos');
    }
};
