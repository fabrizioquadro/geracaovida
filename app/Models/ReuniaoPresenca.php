<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReuniaoPresenca extends Model
{
    use HasFactory;

    protected $fillable = [
        'reuniao_id',
        'membro_id',
    ];

    public function membro(){
        return $this->belongsTo(Membro::class);
    }

    public static function verifica_presenca($reuniao_id, $membro_id){
        $dados = [
            'reuniao_id' => $reuniao_id,
            'membro_id' => $membro_id,
        ];
        if(SELF::where($dados)->count() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
