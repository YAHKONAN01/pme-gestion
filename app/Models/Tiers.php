<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiers extends Model
{
    use HasFactory;

    protected $table = 'tiers';

    protected $fillable = [
        'type',
        'nom',
        'telephone',
        'adresse',
        'plafond_credit',
    ];
}