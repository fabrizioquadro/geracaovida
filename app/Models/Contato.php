<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $fillable = [
        'membro_id',
        'dt_hr_contato',
        'ds_contato',
        'audio_base64',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
