<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'culto_id',
        'membro_id',
        'tp_reserva',
        'nm_convite',
        'presenca_convite',
    ];

    public function membro(){
        return $this->belongsTo(Membro::class);
    }
}
