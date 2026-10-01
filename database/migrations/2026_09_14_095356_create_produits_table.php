<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('reference')->unique();
            $table->string('designation');
            $table->decimal('prix_achat', 12, 2)->default(0);
            $table->decimal('prix_vente', 12, 2)->default(0);
            $table->integer('stock_actuel')->default(0);
            $table->integer('seuil_alerte')->default(5);
            $table->string('methode_valorisation')->default('CUMP'); // Coût Unitaire Moyen Pondéré
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};