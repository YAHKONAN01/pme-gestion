<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action'); // ex: CREATE, UPDATE, DELETE
            $table->string('model');  // ex: Produit, Facture
            $table->unsignedBigInteger('model_id')->nullable();
            $table->json('old_values')->nullable(); // Correction ici
            $table->json('new_values')->nullable(); // Correction ici
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};