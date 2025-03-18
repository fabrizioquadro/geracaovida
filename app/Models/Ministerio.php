<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministerio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nm_ministerio',
        'ds_ministerio',
        'st_reuniao',
        'st_geral',
    ];

    public function usuarios(){
        return $this->belongsToMany(User::class);
    }

    public function generos(){
        return $this->hasMany(MinisterioGenero::class);
    }

    public function verifica_genero($genero){
        $dados = [
            'ministerio_id' => $this->id,
            'genero' => $genero,
        ];
        if(MinisterioGenero::where($dados)->count() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
