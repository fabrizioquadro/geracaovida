<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinisterioGenero extends Model
{
    use HasFactory;

    protected $fillable = [
        'ministerio_id',
        'genero',
    ];
}
