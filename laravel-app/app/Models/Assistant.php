<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_Assistant',
        'prenom_Assistant',
        'email_Assistant',
        'motPasse_Assistant',
    ];
}
