<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    use HasFactory;

    protected $fillable = [
        'situacao',
        'nome',
        'genero',
        'fone',
        'email',
        'foto',
        'st_batismo',
        'data_batismo',
        'cooperador',
        'igreja_anterior',
        'funcao',
        'dt_nascimento',
        'alergico',
        'obs',
        'como_veio',
        'postar_redes',
        'aceita_msg',
        'recebeu_lembranca',
        'audio_base64',
        'pai_id',
        'mae_id',
        'cpf',
        'rg',
        'endereco',
    ];

    public function conjugue(){
        if($this->genero == "Homem"){
            $familia = Familia::where('pai_id', $this->id)->first();
            if($familia){
                return Membro::where('id', $familia->mae_id)->first();
            }
        }
        elseif($this->genero == "Mulher"){
            $familia = Familia::where('mae_id', $this->id)->first();
            if($familia){
                return Membro::where('id', $familia->pai_id)->first();
            }
        }
        return NULL;
    }

    public function pai(){
        return SELF::where('id', $this->pai_id)->first();
    }

    public function mae(){
        return SELF::where('id', $this->pai_id)->first();
    }

    public function filhos(){
        return SELF::where('pai_id', $this->id)
        ->orWhere('mae_id', $this->id)
        ->get();
    }

    public function confere_presenca($culto_id){
        $dados = [
            'membro_id' => $this->id,
            'culto_id' => $culto_id,
        ];
        if(CultoPresenca::where($dados)->count() > 0){
            return 'checked';
        }
        else{
            return '';
        }
    }

    public function confere_presenca_oracao($culto_id){
        $dados = [
            'membro_id' => $this->id,
            'culto_id' => $culto_id,
        ];
        $presenca = CultoPresenca::where($dados)->first();

        if($presenca){
            if($presenca->presenca_oracao == "Sim"){
                return 'checked';
            }
            else{
                return '';
            }
        }
        else{
            return '';
        }
    }

    public function get_presenca(){
        $cultos = Culto::where('st_culto', 'Finalizado')
        ->orderByDesc('dt_hr_culto')
        ->limit(10)
        ->get();

        $contador = $cultos->count();

        $in = array();
        foreach($cultos as $culto){
            $in[] = $culto->id;
        }

        $conta = CultoPresenca::where('membro_id', $this->id)
        ->whereIn('culto_id', $in)
        ->count();

        return round($conta * 100 / $contador);
    }

    public function verifica_ministerio($ministerio_id){
        $dados = [
            'membro_id' => $this->id,
            'ministerio_id' => $ministerio_id,
        ];
        if(MembroMinisterio::where($dados)->count() > 0){
            return true;
        }
        else{
            return false;
        }
    }


    /*
    public function familia_crianca(){
        return FamiliaFilho::where('filho_id', $this->id)->first();
    }

    public function familia_filhos(){
        return Familia::where('mae_id', $this->id)
        ->orWhere('pai_id', $this->id)->first();
    }

    public function filhos(){
        $filhos = FamiliaFilho::where('familia_id', $this->familia_filhos()->id)->get();
        $array = array();
        foreach($filhos as $filho){
            $array[] = $filho->filho_id;
        }
        return Membro::whereIn('id', $array)->get();
    }

    public function conjugue(){
        if($this->familia_filhos()){
            if($this->genero == "Masculino"){
                return Membro::where('id', $this->familia_filhos()->mae_id)->first();
            }
            else{
                return Membro::where('id', $this->familia_filhos()->pai_id)->first();
            }
        }
        return null;
    }

    public function pai(){
        $familia = Familia::where('id', $this->familia_crianca()->familia_id)->first();
        return Membro::where('id', $familia->pai_id)->first();
    }

    public function mae(){
        $familia = Familia::where('id', $this->familia_crianca()->familia_id)->first();
        return Membro::where('id', $familia->mae_id)->first();
    }

    public function irmaos(){
        $filhos = FamiliaFilho::where('familia_id', $this->familia_crianca()->familia_id)->get();
        $array = array();
        foreach($filhos as $filho){
            if($filho->filho_id != $this->id){
                $array[] = $filho->filho_id;
            }
        }
        return Membro::whereIn('id', $array)->get();
    }
    */

}
