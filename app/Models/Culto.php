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
        'nr_vagas',
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

    //public function ministerio(){
    //    return $this->belongsTo(Ministerio::class);
    //}

    public function ministerios(){
        return $this->belongsToMany(Ministerio::class);
    }

    public function presentes(){
        return $this->hasMany(CultoPresenca::class);
    }

    public function check_reserva($membro_id){
        $dados_where = [
            'culto_id' => $this->id,
            'membro_id' => $membro_id,
            'tp_reserva' => 'Membro',
        ];
        if(Reserva::where($dados_where)->count() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function convites(){
        $dados = [
            'culto_id' => $this->id,
            'tp_reserva' => 'Convite',
        ];
        return Reserva::where($dados)->orderBy('nm_convite')->get();
    }

    public function reservas(){
        $dados = [
            'culto_id' => $this->id,
            'tp_reserva' => 'Membro',
        ];
        return Reserva::where($dados)->get();
    }

    public function get_reservas(){
        return Reserva::where('culto_id', $this->id)->count();
    }
}
