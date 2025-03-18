<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reuniao extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'familia_id',
        'membro_id',
        'tp_reuniao',
        'dt_hr_reuniao',
        'tempo_reuniao',
        'ds_reuniao',
        'ds_parecer',
        'st_reuniao',
        'audio_base64',
    ];

    public function presencas(){
        return $this->hasMany(ReuniaoPresenca::class);
    }

    public function membro(){
        return $this->belongsTo(Membro::class);
    }

    public function familia(){
        return $this->belongsTo(Familia::class);
    }
}
