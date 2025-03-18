<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Culto;
use App\Models\CultoPresenca;
use App\Models\CultoMinisterio;
use App\Models\Membro;
use App\Models\Ministerio;
use App\Models\MinisterioGenero;

class CultoController extends Controller
{
    public function index($tp_culto){
        $cultos = Culto::where('tp_culto', $tp_culto)->get();
        return view('cultos/index', compact('cultos','tp_culto'));
    }

    public function adicionar($tp_culto){
        return view('cultos/adicionar', compact('tp_culto'));
    }

    public function insert(Request $request){
        $dados = [
            'nm_culto' => $request->nm_culto,
            'dt_hr_culto' => $request->dt_culto." ".$request->hr_culto,
            'ds_culto' => $request->ds_culto,
            'st_culto' => 'Aberto',
            'tp_culto' => $request->tp_culto,
        ];

        $culto = Culto::create($dados);

        return redirect()->route('cultos', $request->tp_culto)->with('mensagem', $request->tp_culto.' Cadastrado!');
    }

    public function editar($id){
        $culto = Culto::where('id', $id)->first();

        $var = explode(' ', $culto->dt_hr_culto);
        $dt_culto = $var[0];
        $hr_culto = $var[1];
        return view('cultos/editar', compact('culto','dt_culto','hr_culto'));
    }

    public function update(Request $request){
        $dados = [
            'nm_culto' => $request->nm_culto,
            'dt_hr_culto' => $request->dt_culto." ".$request->hr_culto,
            'ds_culto' => $request->ds_culto,
        ];
        Culto::where('id', $request->culto_id)->update($dados);
        $culto = Culto::where('id', $request->culto_id)->first();

        return redirect()->route('cultos', $culto->tp_culto)->with('mensagem', $culto->tp_culto.' Editado!');
    }

    public function excluir($id){
        $culto = Culto::where('id', $id)->first();
        return view('cultos/excluir', compact('culto'));
    }

    public function delete(Request $request){
        CultoPresenca::where('culto_id', $request->culto_id)->delete();
        $culto = Culto::where('id', $request->culto_id)->first();
        $culto->delete();
        return redirect()->route('cultos', $culto->tp_culto)->with('mensagem', $culto->tp_culto.' Excluído!');
    }

    public function acessar($id){
        $culto = Culto::where('id', $id)->first();
        $var = explode(' ', $culto->dt_hr_culto);
        $dt_culto = $var[0];
        $hr_culto = $var[1];

        $membros = Membro::where('created_at', '<=', $var[0]." 23:59:59")
        ->where('situacao', 'membro')
        ->orderBy('nome')
        ->get();

        $frequentes = Membro::where('created_at', '<=', $var[0]." 23:59:59")
        ->where('situacao', 'Visitante Frequente')
        ->orderBy('nome')
        ->get();

        $primeiras = Membro::where('created_at', '<=', $var[0]." 23:59:59")
        ->where('situacao', 'Primeiras Visitas')
        ->orderBy('nome')
        ->get();

        return view('cultos/acessar', compact('culto','dt_culto','hr_culto','membros','frequentes','primeiras'));
    }

    public function acessar_set(Request $request){
        $culto = Culto::where('id', $request->culto_id)->first();
        $culto->ds_parecer = $request->ds_parecer;
        $culto->audio_base64 = $request->audio_base64;
        $culto->st_culto = 'Finalizado';
        $culto->save();

        return redirect()->route('cultos', $culto->tp_culto)->with('mensagem', $request->tp_culto.' Finalizado!');
    }

    public function presencas($id){
        $culto = Culto::where('id', $id)->first();

        $var = explode(' ', $culto->dt_hr_culto);

        $membros = Membro::where('created_at', '<=', $var[0]." 23:59:59")
        ->where('situacao', 'membro')
        ->orderBy('nome')
        ->get();

        $frequentes = Membro::where('created_at', '<=', $var[0]." 23:59:59")
        ->where('situacao', 'Visitante Frequente')
        ->orderBy('nome')
        ->get();

        $primeiras = Membro::where('created_at', '<=', $var[0]." 23:59:59")
        ->where('situacao', 'Primeiras Visitas')
        ->orderBy('nome')
        ->get();

        return view('cultos/presencas', compact('membros','frequentes','primeiras','culto'));
    }

    public function set_presencas(){
        $dados = [
            'culto_id' => $_GET['culto_id'],
            'membro_id' => $_GET['membro_id'],
        ];
        if($_GET['tipo'] == "inserir"){
            CultoPresenca::create($dados);
            $retorno['controle'] = 'true';
        }
        elseif($_GET['tipo'] == "retirar"){
            CultoPresenca::where($dados)->delete();;
            $retorno['controle'] = 'true';
        }

        echo json_encode($retorno);
    }

    public function set_presencas_oracao(){
        $dados = [
            'culto_id' => $_GET['culto_id'],
            'membro_id' => $_GET['membro_id'],
        ];

        CultoPresenca::where($dados)->delete();;

        if($_GET['tipo'] == "inserir"){
            $dados['presenca_oracao'] = "Sim";
            CultoPresenca::create($dados);
        }

        $retorno['tipo'] = $_GET['tipo'];
        $retorno['membro_id'] = $_GET['membro_id'];
        $retorno['controle'] = 'true';

        echo json_encode($retorno);
    }

    /*

    */
}
