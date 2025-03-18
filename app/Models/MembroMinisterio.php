<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembroMinisterio extends Model
{
    use HasFactory;

    protected $fillable = [
        'membro_id',
        'ministerio_id',
    ];
}
