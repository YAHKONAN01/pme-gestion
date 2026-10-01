<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tiers', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['client', 'fournisseur']);
            $table->string('nom');
            $table->string('telephone')->nullable();
            $table->text('adresse')->nullable();
            $table->decimal('plafond_credit', 12, 2)->default(0); // Utile pour le contrôle des encours clients
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tiers');
    }
};