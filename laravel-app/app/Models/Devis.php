<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'date_Devis',
        'description_Devis',
        'id_Patient',
    ];
}
