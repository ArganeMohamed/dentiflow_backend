<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonances extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'description',
    ];
}
