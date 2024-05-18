<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_Medecin',
        'prenom_Medecin',
        'specialite',
        'salle',
        'mot_de_passe',
    ];
}
