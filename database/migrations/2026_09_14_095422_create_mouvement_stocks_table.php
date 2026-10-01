<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mouvement_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produit_id')->constrained('produits')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('type', ['entree', 'sortie', 'ajustement']);
            $table->integer('quantite');
            $table->decimal('prix_unit', 12, 2)->default(0);
            $table->string('motif')->nullable(); // Ex: Achat fournisseur, Vente client, Inventaire
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mouvement_stocks');
    }
};