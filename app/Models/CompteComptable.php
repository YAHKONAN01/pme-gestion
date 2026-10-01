<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompteComptable extends Model
{
    use HasFactory;

    protected $table = 'compte_comptables';

    protected $fillable = [
        'numero_compte',
        'intitule',
        'classe',
    ];

    public function ecritures(): HasMany
    {
        return $this->hasMany(EcritureComptable::class, 'compte_id');
    }
}