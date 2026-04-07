<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membro;
use App\Models\MembroMinisterio;
use App\Models\Familia;
use App\Models\FamiliaFilho;
use App\Models\Ministerio;

class MembroController extends Controller
{
    public function membros(){
        return $this->index('Membro');
    }

    public function visitas_frequentes(){
        return $this->index('Visitante Frequente');
    }

    public function primeiras_visitas(){
        return $this->index('Primeiras Visitas');
    }

    public function conexao_up(){
        return $this->index('Conexão X Up');
    }

    public function infantil(){
        return $this->index('Infantil');
    }

    public function index($situacao){
        $membros = Membro::where('situacao', $situacao)->get();
        return view('membros/index', compact('membros','situacao'));
    }

    public function adicionar($situacao, $genero){
        switch ($genero)
        {
            case 'Homem':
                $membros = Membro::where('genero','Mulher')->get();
                $ministerios = Ministerio::where('st_geral','<>','Sim')->get();
                return view('membros/adicionar_individual', compact('situacao','genero','membros','ministerios'));
                break;
            case 'Mulher':
                $membros = Membro::where('genero','Homem')->get();
                $ministerios = Ministerio::where('st_geral','<>','Sim')->get();
                return view('membros/adicionar_individual', compact('situacao','genero','membros','ministerios'));
                break;
            case 'Casal':
                $ministerios = Ministerio::where('st_geral','<>','Sim')->get();
                return view('membros/adicionar_casal', compact('situacao','genero','ministerios'));
                break;
            case 'Jovem':
                $pais = Membro::where('genero','Homem')->get();
                $maes = Membro::where('genero','Mulher')->get();
                $ministerios = Ministerio::where('st_geral','<>','Sim')->get();
                return view('membros/adicionar_crianca', compact('situacao','genero','pais','maes','ministerios'));
                break;
            case 'Adolescente':
                $pais = Membro::where('genero','Homem')->get();
                $maes = Membro::where('genero','Mulher')->get();
                $ministerios = Ministerio::where('st_geral','<>','Sim')->get();
                return view('membros/adicionar_crianca', compact('situacao','genero','pais','maes','ministerios'));
                break;
            case 'Pré-adolescente':
                $pais = Membro::where('genero','Homem')->get();
                $maes = Membro::where('genero','Mulher')->get();
                $ministerios = Ministerio::where('st_geral','<>','Sim')->get();
                return view('membros/adicionar_crianca', compact('situacao','genero','pais','maes','ministerios'));
                break;
            case 'Criança':
                $pais = Membro::where('genero','Homem')->get();
                $maes = Membro::where('genero','Mulher')->get();
                $ministerios = Ministerio::where('st_geral','<>','Sim')->get();
                return view('membros/adicionar_crianca', compact('situacao','genero','pais','maes','ministerios'));
                break;
            case 'Infantil A':
                $pais = Membro::where('genero','Homem')->get();
                $maes = Membro::where('genero','Mulher')->get();
                $ministerios = Ministerio::where('st_geral','<>','Sim')->get();
                return view('membros/adicionar_crianca', compact('situacao','genero','pais','maes','ministerios'));
                break;
            case 'Infantil B':
                $pais = Membro::where('genero','Homem')->get();
                $maes = Membro::where('genero','Mulher')->get();
                $ministerios = Ministerio::where('st_geral','<>','Sim')->get();
                return view('membros/adicionar_crianca', compact('situacao','genero','pais','maes','ministerios'));
                break;
            case 'Berçário':
                $pais = Membro::where('genero','Homem')->get();
                $maes = Membro::where('genero','Mulher')->get();
                $ministerios = Ministerio::where('st_geral','<>','Sim')->get();
                return view('membros/adicionar_crianca', compact('situacao','genero','pais','maes','ministerios'));
                break;
        }
    }

    public function insert(Request $request){
        if($request->genero == "Homem" || $request->genero == 'Mulher' || $request->genero == 'Jovem' ||
        $request->genero == 'Criança' || $request->genero == "Adolescente" ||
        $request->genero == "Pré-adolescente" || $request->genero == "Infantil A" ||
        $request->genero == "Infantil B" || $request->genero == "Berçário"){
            $dados = $request->except('_token','conjugue','foto','ministerios');

            $membro = Membro::create($dados);

            if($request->hasFile('foto') && $request->file('foto')->isValid()){
                $foto = $request->foto;
                $extensao = $foto->extension();

                $nmImagem = $membro->id.".".$extensao;
                $request->foto->move(public_path('img/membros'), $nmImagem);

                $membro->foto = $nmImagem;
                $membro->save();

            }

            if($request->ministerios){
                foreach($request->ministerios as $ministerio_id){
                    $dados = [
                        'membro_id' => $membro->id,
                        'ministerio_id' => $ministerio_id,
                    ];

                    MembroMinisterio::create($dados);
                }
            }

            if($request->conjugue){
                $conjugue = Membro::where('id', $request->conjugue)->first();
                if($membro->genero == 'Homem'){
                    $dados_familia = [
                        'pai_id' => $membro->id,
                        'mae_id' => $conjugue->id,
                    ];
                }
                else{
                    $dados_familia = [
                        'pai_id' => $conjugue->id,
                        'mae_id' => $membro->id,
                    ];
                }

                Familia::create($dados_familia);
            }
        }
        elseif($request->genero == 'Casal'){
            $dados_homem = [
                'situacao' => $request->situacao,
                'genero' => 'Homem',
                'nome' => $request->nome_pai,
                'fone' => $request->fone_pai,
                'email' => $request->email_pai,
                'dt_nascimento' => $request->dt_nascimento_pai,
                'st_batismo' => $request->st_batismo_pai,
                'data_batismo' => $request->data_batismo_pai,
                'cooperador' => $request->cooperador_pai,
                'funcao' => $request->funcao_pai,
                'como_veio' => $request->como_veio_pai,
                'postar_redes' => $request->postar_redes_pai,
                'aceita_msg' => $request->aceita_msg_pai,
                'igreja_anterior' => $request->igreja_anterior_pai,
                'recebeu_lembranca' => $request->recebeu_lembranca_pai,
                'obs' => $request->recebeu_lembranca_pai,
                'audio_base64' => $request->audio_base64_pai,
                'cpf' => $request->cpf_pai,
                'rg' => $request->rg_pai,
                'endereco' => $request->endereco_pai,
            ];

            $homem = Membro::create($dados_homem);

            if($request->hasFile('foto_pai') && $request->file('foto_pai')->isValid()){
                $foto = $request->foto_pai;
                $extensao = $foto->extension();

                $nmImagem = $homem->id.".".$extensao;
                $request->foto_pai->move(public_path('img/membros'), $nmImagem);

                $homem->foto = $nmImagem;
                $homem->save();

            }

            foreach($request->ministerios_pai as $ministerio_id){
                $dados = [
                    'membro_id' => $homem->id,
                    'ministerio_id' => $ministerio_id,
                ];

                MembroMinisterio::create($dados);
            }



            $dados_mulher = [
                'situacao' => $request->situacao,
                'genero' => 'Mulher',
                'nome' => $request->nome_mae,
                'fone' => $request->fone_mae,
                'email' => $request->email_mae,
                'dt_nascimento' => $request->dt_nascimento_mae,
                'st_batismo' => $request->st_batismo_mae,
                'data_batismo' => $request->data_batismo_mae,
                'cooperador' => $request->cooperador_mae,
                'funcao' => $request->funcao_mae,
                'como_veio' => $request->como_veio_mae,
                'postar_redes' => $request->postar_redes_mae,
                'aceita_msg' => $request->aceita_msg_mae,
                'igreja_anterior' => $request->igreja_anterior_mae,
                'recebeu_lembranca' => $request->recebeu_lembranca_mae,
                'obs' => $request->recebeu_lembranca_mae,
                'audio_base64' => $request->audio_base64_mae,
                'cpf' => $request->cpf_mae,
                'rg' => $request->rg_mae,
                'endereco' => $request->endereco_mae,
            ];

            $mulher = Membro::create($dados_mulher);

            if($request->hasFile('foto_mae') && $request->file('foto_mae')->isValid()){
                $foto = $request->foto_mae;
                $extensao = $foto->extension();

                $nmImagem = $mulher->id.".".$extensao;
                $request->foto_mae->move(public_path('img/membros'), $nmImagem);

                $mulher->foto = $nmImagem;
                $mulher->save();

            }

            foreach($request->ministerios_pai as $ministerio_id){
                $dados = [
                    'membro_id' => $mulher->id,
                    'ministerio_id' => $ministerio_id,
                ];

                MembroMinisterio::create($dados);
            }

            $dados_familia = [
                'pai_id' => $homem->id,
                'mae_id' => $mulher->id,
            ];

            Familia::create($dados_familia);
        }

        if($request->situacao == "Membro"){
            $redirect = 'membros';
        }
        elseif($request->situacao == "Visitante Frequente"){
            $redirect = 'visitas_frequentes';
        }
        elseif($request->situacao == "Primeiras Visitas"){
            $redirect = 'primeiras_visitas';
        }
        elseif($request->situacao == "Conexão X Up"){
            $redirect = 'conexao_up';
        }
        elseif($request->situacao == "Infantil"){
            $redirect = 'infantil';
        }

        return redirect()->route($redirect)->with('mensagem','Membro Cadastrado');
    }

    public function editar($id){
        $membro = Membro::where('id', $id)->first();
        $ministerios = Ministerio::where('st_geral','<>','Sim')->get();
        if($membro->genero == "Jovem" || $membro->genero == "Criança" || $membro->genero == "Adolescente" ||
        $membro->genero == "Pré-adolescente" || $membro->genero == "Infantil A" ||
        $membro->genero == "Infantil B" || $membro->genero == "Berçário"){
            $pais = Membro::where('genero','Homem')->get();
            $maes = Membro::where('genero','Mulher')->get();
            return view('membros/editar_crianca', compact('membro','pais','maes','ministerios'));
        }
        else{
            if($membro->genero == "Homem"){
                $membros = Membro::where('genero','Mulher')->get();
            }
            else{
                $membros = Membro::where('genero','Homem')->get();
            }
            return view('membros/editar_individual', compact('membro','membros','ministerios'));
        }
    }

    public function update(Request $request){
        $dados = $request->except('_token','membro_id','audio_base64','foto','conjugue','ministerios');
        if($request->audio_base64){
            $dados['audio_base64'] = $request->audio_base64;
        }
        Membro::where('id', $request->membro_id)->update($dados);
        $membro = Membro::where('id', $request->membro_id)->first();

        if($request->hasFile('foto') && $request->file('foto')->isValid()){
            $foto = $request->foto;
            $extensao = $foto->extension();

            $nmImagem = $membro->id.".".$extensao;
            $request->foto->move(public_path('img/membros'), $nmImagem);

            $membro->foto = $nmImagem;
            $membro->save();
        }

        MembroMinisterio::where('membro_id', $membro->id)->delete();
        foreach($request->ministerios as $ministerio_id){
            $dados = [
                'membro_id' => $membro->id,
                'ministerio_id' => $ministerio_id,
            ];

            MembroMinisterio::create($dados);
        }

        if($request->conjugue){
            if(!$membro->conjugue() || $request->conjugue != $membro->conjugue()->id){
                Familia::where('pai_id', $membro->id)->orWhere('mae_id', $membro->id)->delete();
                $conjugue = Membro::where('id', $request->conjugue)->first();
                if($membro->genero == 'Homem'){
                    $dados_familia = [
                        'pai_id' => $membro->id,
                        'mae_id' => $conjugue->id,
                    ];
                }
                else{
                    $dados_familia = [
                        'pai_id' => $conjugue->id,
                        'mae_id' => $membro->id,
                    ];
                }

                Familia::create($dados_familia);
            }
        }
        else{
            Familia::where('pai_id', $membro->id)->orWhere('mae_id', $membro->id)->delete();
        }

        if($membro->situacao == "Membro"){
            $redirect = 'membros';
        }
        elseif($membro->situacao == "Visitante Frequente"){
            $redirect = 'visitas_frequentes';
        }
        elseif($membro->situacao == "Primeiras Visitas"){
            $redirect = 'primeiras_visitas';
        }
        elseif($membro->situacao == "Conexão X Up"){
            $redirect = 'conexao_up';
        }
        elseif($membro->situacao == "Infantil"){
            $redirect = 'infantil';
        }

        return redirect()->route($redirect)->with('mensagem','Membro Editado!');

    }

    public function visualizar($id){
        $membro = Membro::where('id', $id)->first();
        if($membro->genero == "Jovem" || $membro->genero == "Criança" || $membro->genero == "Adolescente" ||
        $membro->genero == "Pré-adolescente" || $membro->genero == "Infantil A" ||
        $membro->genero == "Infantil B" || $membro->genero == "Berçário"){
            return view('membros/visualizar_crianca', compact('membro'));
        }
        else{
            return view('membros/visualizar_individual', compact('membro'));
        }
    }

    public function excluir($id){
        $membro = Membro::where('id', $id)->first();
        return view('membros/excluir', compact('membro'));
    }

    public function delete(Request $request){
        $membro = Membro::where('id', $request->membro_id)->first();
        Familia::where('pai_id', $membro->id)
        ->orWhere('mae_id', $membro->id)
        ->delete();

        Membro::where('mae_id', $membro->id)->update(['mae_id' => NULL]);
        Membro::where('pai_id', $membro->id)->update(['pai_id' => NULL]);
        MembroMinisterio::where('membro_id', $membro->id)->delete();

        $membro->delete();

        if($membro->situacao == "Membro"){
            $redirect = 'membros';
        }
        elseif($membro->situacao == "Visitante Frequente"){
            $redirect = 'visitas_frequentes';
        }
        elseif($membro->situacao == "Primeiras Visitas"){
            $redirect = 'primeiras_visitas';
        }
        elseif($membro->situacao == "Conexão X Up"){
            $redirect = 'conexao_up';
        }
        elseif($membro->situacao == "Infantil"){
            $redirect = 'infantil';
        }

        return redirect()->route($redirect)->with('mensagem','Membro Excluído!');
    }

    public function enviar_visitas_frequentes($id){
        $membro = Membro::where('id', $id)->first();
        return view('membros/enviar_visitas_frequentes', compact('membro'));
    }

    public function enviar_visitas_frequentes_set(Request $request){
        $membro = Membro::where('id', $request->membro_id)->first();
        $membro->situacao = "Visitante Frequente";
        $membro->save();

        return redirect()->route('primeiras_visitas')->with('mensagem','Membro Enviado para Visitantes Frequentes!');
    }

    public function batizar($id){
        $membro = Membro::where('id', $id)->first();
        return view('membros/batizar', compact('membro'));
    }

    public function batizar_set(Request $request){
        $membro = Membro::where('id', $request->membro_id)->first();
        $redirect = $membro->situacao;
        $membro->data_batismo = $request->data_batismo;
        $membro->cooperador = $request->cooperador;
        $membro->funcao = $request->funcao;
        $membro->situacao = 'Membro';
        $membro->save();

        if($redirect == "Membro"){
            $redirect = 'membros';
        }
        elseif($redirect == "Visitante Frequente"){
            $redirect = 'visitas_frequentes';
        }
        elseif($redirect == "Primeiras Visitas"){
            $redirect = 'primeiras_visitas';
        }
        elseif($redirect == "Conexão X Up"){
            $redirect = 'conexao_up';
        }
        elseif($redirect == "Infantil"){
            $redirect = 'infantil';
        }

        return redirect()->route($redirect)->with('mensagem','Membro Batizado!');
    }

    public function familia($id){
        $membro = Membro::where('id', $id)->first();

        return view('membros/familia', compact('membro'));
    }

}
