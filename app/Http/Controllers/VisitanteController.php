<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membro;
use App\Models\Familia;
use App\Models\FamiliaFilho;

class VisitanteController extends Controller
{
    public function index(){
        $visitantes = Membro::where('situacao', 'Visitante')->get();
        return view('visitantes/index', compact('visitantes'));
    }

    public function adicionar($tipo){
        if($tipo == "individual"){
            return view('visitantes/adicionar_individual', compact('tipo'));
        }
        elseif($tipo == "crianca"){
            $maes = Membro::where('genero', 'Feminino')->orderBy('nome')->get();
            $pais = Membro::where('genero', 'Masculino')->orderBy('nome')->get();
            return view('visitantes/adicionar_crianca', compact('tipo','pais','maes'));
        }
        elseif($tipo == "familia"){
            return view('visitantes/adicionar_familia', compact('tipo'));
        }
    }

    public function insert(Request $request){
        if($request->get('tipo') == "individual" || $request->get('tipo') == "crianca"){
            $dados = $request->except('_token','tipo','foto','mae_id','pai_id');
            $dados['situacao'] = "Visitante";

            $membro = Membro::create($dados);

            if($request->hasFile('foto') && $request->file('foto')->isValid()){
                $foto = $request->foto;
                $extensao = $foto->extension();

                $nmImagem = $membro->id.".".$extensao;
                $request->foto->move(public_path('img/membros'), $nmImagem);

                $membro->foto = $nmImagem;
                $membro->save();

            }

            if($request->get('tipo') == "crianca"){
                if($request->get('pai_id') || $request->get('mae_id')){
                    $dados_familia = [
                        'pai_id' => $request->get('pai_id'),
                        'mae_id' => $request->get('mae_id'),
                    ];

                    $familia = Familia::where($dados_familia)->first();
                    if(!$familia){
                        $familia = Familia::create($dados_familia);
                    }

                    $dados = [
                        'familia_id' => $familia->id,
                        'filho_id' => $membro->id,
                    ];
                    FamiliaFilho::create($dados);
                }
            }

            return redirect()->route('visitantes')->with('mensagem', 'Membro Cadastrado!');
        }
        elseif($request->get('tipo') == "familia"){
            $dados_pai = [
                'nome' => $request->get('nome_pai'),
                'situacao' => 'Visitante',
                'genero' => 'Masculino',
                'fone' => $request->get('fone_pai'),
                'email' => $request->get('email_pai'),
                'dt_nascimento' => $request->get('dt_nascimento_pai'),
                'igreja_anterior' => $request->get('igreja_anterior_pai'),
                'recebeu_lembranca' => $request->get('recebeu_lembranca_pai'),
                'como_veio' => $request->get('como_veio_pai'),
                'postar_redes' => $request->get('postar_redes_pai'),
                'aceita_msg' => $request->get('aceita_msg_pai'),
                'obs' => $request->get('obs_pai'),
            ];

            $pai = Membro::create($dados_pai);
            if($request->hasFile('foto_pai') && $request->file('foto_pai')->isValid()){
                $foto = $request->foto_pai;
                $extensao = $foto->extension();

                $nmImagem = $pai->id.".".$extensao;
                $request->foto_pai->move(public_path('img/membros'), $nmImagem);

                $pai->foto = $nmImagem;
                $pai->save();

            }

            $dados_mae = [
                'nome' => $request->get('nome_mae'),
                'situacao' => 'Visitante',
                'genero' => 'Feminino',
                'fone' => $request->get('fone_mae'),
                'email' => $request->get('email_mae'),
                'dt_nascimento' => $request->get('dt_nascimento_mae'),
                'igreja_anterior' => $request->get('igreja_anterior_mae'),
                'recebeu_lembranca' => $request->get('recebeu_lembranca_mae'),
                'como_veio' => $request->get('como_veio_mae'),
                'postar_redes' => $request->get('postar_redes_mae'),
                'aceita_msg' => $request->get('aceita_msg_mae'),
                'obs' => $request->get('obs_mae'),
            ];

            $mae = Membro::create($dados_mae);
            if($request->hasFile('foto_mae') && $request->file('foto_mae')->isValid()){
                $foto = $request->foto_mae;
                $extensao = $foto->extension();

                $nmImagem = $mae->id.".".$extensao;
                $request->foto_mae->move(public_path('img/membros'), $nmImagem);

                $mae->foto = $nmImagem;
                $mae->save();

            }

            $dados_familia = [
                'pai_id' => $pai->id,
                'mae_id' => $mae->id,
            ];
            $familia = Familia::create($dados_familia);

            for($i=1 ; $i<= $request->get('contador_filhos') ; $i++){
                $var = 'nome_filho'.$i;
                $nome = $request->get($var);

                $var = 'dt_nascimento_filho'.$i;
                $dt_nascimento = $request->get($var);

                $var = 'alergico_filho'.$i;
                $alergico = $request->get($var);

                $var = 'recebeu_lembranca_filho'.$i;
                $recebeu_lembranca = $request->get($var);

                $var = 'obs_filho'.$i;
                $obs = $request->get($var);

                if($nome){
                    $dados_filho = [
                        'nome' => $nome,
                        'situacao' => 'Visitante',
                        'genero' => 'Criança',
                        'dt_nascimento' => $dt_nascimento,
                        'alergico' => $alergico,
                        'recebeu_lembranca' => $recebeu_lembranca,
                        'obs' => $obs,
                    ];
                    $filho = Membro::create($dados_filho);

                    $dados = [
                        'familia_id' => $familia->id,
                        'filho_id' => $filho->id,
                    ];
                    FamiliaFilho::create($dados);

                    $var = 'foto_filho'.$i;
                    if($request->hasFile($var) && $request->file($var)->isValid()){
                        $foto = $request->$var;
                        $extensao = $foto->extension();

                        $nmImagem = $filho->id.".".$extensao;
                        $request->$var->move(public_path('img/membros'), $nmImagem);

                        $filho->foto = $nmImagem;
                        $filho->save();
                    }
                }
            }
            return redirect()->route('visitantes')->with('mensagem', 'Família Cadastrada!');
        }
    }

    public function editar($id){
        $membro = Membro::where('id', $id)->first();
        if($membro->genero == "Masculino" || $membro->genero == "Feminino"){
            return view('visitantes/editar_individual', compact('membro'));
        }
        elseif($membro->genero == 'Criança'){
            return view('visitantes/editar_crianca', compact('membro'));
        }
    }

    public function update(Request $request){
        $dados = $request->except('_token','membro_id','foto');
        Membro::where('id', $request->get('membro_id'))->update($dados);

        $membro = Membro::where('id', $request->get('membro_id'))->first();
        if($request->hasFile('foto') && $request->file('foto')->isValid()){
            $foto = $request->foto;
            $extensao = $foto->extension();

            $nmImagem = $membro->id.".".$extensao;
            $request->foto->move(public_path('img/membros'), $nmImagem);

            $membro->foto = $nmImagem;
            $membro->save();

        }
        return redirect()->route('visitantes')->with('mensagem', 'Visitante Editado!');
    }

    public function visualizar($id){
        $membro = Membro::where('id', $id)->first();
        if($membro->genero == "Masculino" || $membro->genero == "Feminino"){
            return view('visitantes/visualizar_individual', compact('membro'));
        }
        elseif($membro->genero == 'Criança'){
            return view('visitantes/visualizar_crianca', compact('membro'));
        }
    }

    public function excluir($id){
        $membro = Membro::where('id', $id)->first();
        return view('visitantes/excluir', compact('membro'));
    }

    public function delete(Request $request){
        $membro = Membro::where('id', $request->get('membro_id'))->first();
        if($membro->genero == "Criança"){
            FamiliaFilho::where('filho_id', $membro->id)->delete();
        }
        elseif($membro->genero == "Masculino"){
            $familia = Familia::where('pai_id', $membro->id)->first();
            if($familia){
                $familia->pai_id = null;
                $familia->save();
            }
        }
        elseif($membro->genero == "Feminino"){
            $familia = Familia::where('mae_id', $membro->id)->first();
            if($familia){
                $familia->mae_id = null;
                $familia->save();
            }
        }

        $membro->delete();
        return redirect()->route('visitantes')->with('mensagem','Visitante Excluído!');
    }

    public function batizar($id){
        $membro = Membro::where('id', $id)->first();
        return view('visitantes/batizar', compact('membro'));
    }

    public function batizar_set(Request $request){
        $membro = Membro::where('id', $request->get('membro_id'))->first();
        $membro->situacao = 'Membro';
        $membro->data_batismo = $request->get('batizar_set');
        $membro->cooperador = $request->get('cooperador');
        $membro->funcao = $request->get('funcao');

        $membro->save();
        return redirect()->route('visitantes')->with('memsagem','Visitante Batizado!');
    }

}
