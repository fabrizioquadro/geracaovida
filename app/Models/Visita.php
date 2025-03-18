<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'membro_id',
        'user_id',
        'dt_hr_visita',
        'ds_visita',
        'ds_resumo',
        'nr_cep',
        'ds_endereco',
        'nr_endereco',
        'ds_complemento',
        'ds_bairro',
        'nm_cidade',
        'ds_uf',
        'st_visita',
        'audio_base64',
        'audio_whats',
    ];

    public function membro(){
        return $this->belongsTo(Membro::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
