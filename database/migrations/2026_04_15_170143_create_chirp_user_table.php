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
        Schema::create('chirp_user', function (Blueprint $table) {
            $table->id();
            // Cria a coluna user_id e conecta com a tabela users
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Cria a coluna chirp_id e conecta com a tabela chirps
            $table->foreignId('chirp_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chirp_user');
    }
};