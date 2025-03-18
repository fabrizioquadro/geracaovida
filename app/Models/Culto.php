<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Culto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nm_culto',
        'dt_hr_culto',
        'ds_culto',
        'ds_parecer',
        'st_culto',
        'tp_culto',
        'audio_base64',
        'ministerio_id',
    ];

    public function verifica_ministerio($ministerio_id){
        $dados = [
            'culto_id' => $this->id,
            'ministerio_id' => $ministerio_id,
        ];

        if(CultoMinisterio::where($dados)->count() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function ministerio(){
        return $this->belongsTo(Ministerio::class);
    }

    public function presentes(){
        return $this->hasMany(CultoPresenca::class);
    }
}
