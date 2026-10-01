<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ecriture_comptables', function (Blueprint $table) {
            $table->id();
            $table->string('journal_code', 10); // ACH, VTE, BQ, OD
            $table->foreignId('compte_id')->constrained('compte_comptables')->cascadeOnDelete();
            $table->string('libelle');
            $table->decimal('debit', 12, 2)->default(0);
            $table->decimal('credit', 12, 2)->default(0);
            $table->date('date_ecriture');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ecriture_comptables');
    }
};