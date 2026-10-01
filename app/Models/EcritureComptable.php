<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EcritureComptable extends Model
{
    use HasFactory;

    protected $table = 'ecriture_comptables';

    protected $fillable = [
        'journal_code',
        'compte_id',
        'libelle',
        'debit',
        'credit',
        'date_ecriture',
    ];

    public function compte(): BelongsTo
    {
        return $this->belongsTo(CompteComptable::class, 'compte_id');
    }
}