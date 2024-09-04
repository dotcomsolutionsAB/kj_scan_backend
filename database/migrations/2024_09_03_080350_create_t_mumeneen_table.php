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
        Schema::create('t_mumeneen', function (Blueprint $table) {
            $table->id();
            $table->integer('its')->unique();
            $table->string('name');
            $table->string('mobile')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->integer('age')->nullable();
            $table->string('arabic_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_mumeneen');
    }
};
