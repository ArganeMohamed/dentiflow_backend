<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appareil extends Model
{
    use HasFactory;

    protected $table = 'appareils';
    protected $fillable = [
        'nom_Appareil',
        'description_Appareil'
    ];
}
