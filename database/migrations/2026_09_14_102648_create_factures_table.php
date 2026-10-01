<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique(); // ex: FAC-2026-0001
            $table->foreignId('tiers_id')->constrained('tiers')->cascadeOnDelete(); // Client
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Commercial / Caissier
            $table->date('date_facture');
            $table->decimal('montant_ht', 12, 2)->default(0);
            $table->decimal('montant_tva', 12, 2)->default(0);
            $table->decimal('montant_ttc', 12, 2)->default(0);
            $table->enum('statut', ['impayee', 'partielle', 'payee'])->default('impayee');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};