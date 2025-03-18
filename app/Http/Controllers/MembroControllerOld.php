<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membro;
use App\Models\Familia;
use App\Models\FamiliaFilho;

class MembroController extends Controller
{
    public function index(){
        $membros = Membro::where('situacao', 'Membro')->get();
        return view('membros/index', compact('membros'));
    }

    public function adicionar($tipo){
        if($tipo == "individual"){
            return view('membros/adicionar_individual', compact('tipo'));
        }
        elseif($tipo == "crianca"){
            $maes = Membro::where('genero', 'Feminino')->orderBy('nome')->get();
            $pais = Membro::where('genero', 'Masculino')->orderBy('nome')->get();
            return view('membros/adicionar_crianca', compact('tipo','pais','maes'));
        }
        elseif($tipo == "familia"){
            return view('membros/adicionar_familia', compact('tipo'));
        }
    }

    public function insert(Request $request){
        if($request->get('tipo') == "individual" || $request->get('tipo') == "crianca"){
            $dados = $request->except('_token','tipo','foto','mae_id','pai_id');
            $dados['situacao'] = "Membro";

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

            return redirect()->route('membros')->with('mensagem', 'Membro Cadastrado!');
        }
        elseif($request->get('tipo') == "familia"){
            $dados_pai = [
                'nome' => $request->get('nome_pai'),
                'situacao' => 'Membro',
                'genero' => 'Masculino',
                'fone' => $request->get('fone_pai'),
                'email' => $request->get('email_pai'),
                'dt_nascimento' => $request->get('dt_nascimento_pai'),
                'data_batismo' => $request->get('data_batismo_pai'),
                'cooperador' => $request->get('cooperador_pai'),
                'funcao' => $request->get('funcao_pai'),
                'igreja_anterior' => $request->get('igreja_anterior_pai'),
                'recebeu_lembranca' => $request->get('recebeu_lembranca_pai'),
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
                'situacao' => 'Membro',
                'genero' => 'Feminino',
                'fone' => $request->get('fone_mae'),
                'email' => $request->get('email_mae'),
                'dt_nascimento' => $request->get('dt_nascimento_mae'),
                'data_batismo' => $request->get('data_batismo_mae'),
                'cooperador' => $request->get('cooperador_mae'),
                'funcao' => $request->get('funcao_mae'),
                'igreja_anterior' => $request->get('igreja_anterior_mae'),
                'recebeu_lembranca' => $request->get('recebeu_lembranca_mae'),
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
                        'situacao' => 'Membro',
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
            return redirect()->route('membros')->with('mensagem', 'Família Cadastrada!');
        }
    }

    public function editar($id){
        $membro = Membro::where('id', $id)->first();
        if($membro->genero == "Masculino" || $membro->genero == "Feminino"){
            return view('membros/editar_individual', compact('membro'));
        }
        elseif($membro->genero == 'Criança'){
            return view('membros/editar_crianca', compact('membro'));
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
        return redirect()->route('membros')->with('mensagem', 'Membro Editado!');
    }

    public function visualizar($id){
        $membro = Membro::where('id', $id)->first();
        if($membro->genero == "Masculino" || $membro->genero == "Feminino"){
            return view('membros/visualizar_individual', compact('membro'));
        }
        elseif($membro->genero == 'Criança'){
            return view('membros/visualizar_crianca', compact('membro'));
        }
    }

    public function excluir($id){
        $membro = Membro::where('id', $id)->first();
        return view('membros/excluir', compact('membro'));
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
        return redirect()->route('membros')->with('mensagem','Membro Excluído!');
    }

}
