<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compte_comptables', function (Blueprint $table) {
            $table->id();
            $table->string('numero_compte')->unique(); // ex: 411000 Client
            $table->string('intitule');
            $table->integer('classe'); // Classe SYSCOHADA (1 à 9)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compte_comptables');
    }
};