<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultoPresenca extends Model
{
    use HasFactory;

    protected $fillable = [
        'culto_id',
        'membro_id',
        'presenca_oracao',
    ];

    public function membro(){
        return $this->belongsTo(Membro::class);
    }
}
