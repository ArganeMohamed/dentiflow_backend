<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traitement extends Model
{
    use HasFactory;
    protected $fillable = [
        'dent',
        'description',
        'cout',
        'id_Devis',
        'id_Facture',
        'id_Ordanance',
    ];
}
