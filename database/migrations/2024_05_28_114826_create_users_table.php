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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('first_last_name');
            $table->string('second_last_name');
            $table->string('email');
            $table->string('password');
            $table->string('association_id');
            $table->string('role');
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('association_id')->references('id')->on('associations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
