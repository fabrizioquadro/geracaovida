<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ministerio;
use App\Models\MinisterioGenero;
use App\Models\Membro;
use App\Models\MembroMinisterio;
use App\Models\Culto;
use App\Models\CultoMinisterio;

class ReuniaoController extends Controller
{
    public function index($ministerio_id){
        $ministerio = Ministerio::where('id', $ministerio_id)->first();

        $cultos = Culto::where('ministerio_id', $ministerio->id)
        ->where('tp_culto', 'Atividade')
        ->get();
        return view('reunioes/index', compact('cultos','ministerio'));
    }

    public function acessar($id){
        $culto = Culto::where('id', $id)->first();
        $ministerio = Ministerio::where('id', $culto->ministerio_id)->first();

        //vamos buscar os generos que fazem parte dessos ministerios do culto
        $membros = MembroMinisterio::where('ministerio_id', $culto->ministerio_id)->get();
        $in = array();
        foreach($membros as $membro){
            $in[] = $membro->membro_id;
        }

        $var = explode(' ', $culto->dt_hr_culto);
        $membros = Membro::where('created_at', '<=', $var[0]." 23:59:59")
        ->where('situacao', 'Membro')
        ->whereIn('id', $in)
        ->orderBy('nome')
        ->get();

        $frequentes = Membro::where('created_at', '<=', $var[0]." 23:59:59")
        ->where('situacao', 'Visitante Frequente')
        ->whereIn('id', $in)
        ->orderBy('nome')
        ->get();

        $primeiras = Membro::where('created_at', '<=', $var[0]." 23:59:59")
        ->where('situacao', 'Primeiras Visitas')
        ->whereIn('id', $in)
        ->orderBy('nome')
        ->get();

        $var = explode(' ', $culto->dt_hr_culto);
        $dt_culto = $var[0];
        $hr_culto = $var[1];
        return view('reunioes/acessar', compact('culto','dt_culto','hr_culto','ministerio','membros','frequentes','primeiras'));
    }

    public function acessar_set(Request $request){
        $culto = Culto::where('id', $request->culto_id)->first();
        $culto->ds_parecer = $request->ds_parecer;
        $culto->audio_base64 = $request->audio_base64;
        $culto->st_culto = 'Finalizado';
        $culto->save();

        return redirect()->route('reunioes', $request->ministerio_id)->with('mensagem','Culto/Reunião Finalizado!');
    }

    public function presenca($id){
        $culto = Culto::where('id', $id)->first();
        $ministerio = Ministerio::where('id', $culto->ministerio_id)->first();

        //vamos buscar os generos que fazem parte dessos ministerios do culto
        $membros = MembroMinisterio::where('ministerio_id', $culto->ministerio_id)->get();
        $in = array();
        foreach($membros as $membro){
            $in[] = $membro->membro_id;
        }

        $var = explode(' ', $culto->dt_hr_culto);
        $membros = Membro::where('created_at', '<=', $var[0]." 23:59:59")
        ->where('situacao', 'Membro')
        ->whereIn('id', $in)
        ->orderBy('nome')
        ->get();

        $frequentes = Membro::where('created_at', '<=', $var[0]." 23:59:59")
        ->where('situacao', 'Visitante Frequente')
        ->whereIn('id', $in)
        ->orderBy('nome')
        ->get();

        $primeiras = Membro::where('created_at', '<=', $var[0]." 23:59:59")
        ->where('situacao', 'Primeiras Visitas')
        ->whereIn('id', $in)
        ->orderBy('nome')
        ->get();

        return view('reunioes/presenca', compact('membros','frequentes','primeiras','culto','ministerio'));
    }

    public function adicionar($id){
        $ministerio = Ministerio::where('id', $id)->first();

        return view('reunioes/adicionar', compact('ministerio'));
    }

    public function insert(Request $request){
        $dados = [
            'nm_culto' => $request->nm_culto,
            'dt_hr_culto' => $request->dt_culto." ".$request->hr_culto,
            'ds_culto' => $request->ds_culto,
            'ds_parecer' => $request->ds_parecer,
            'st_culto' => 'Finalizado',
            'tp_culto' => 'Atividade',
            'audio_base64' => $request->audio_base64,
            'ministerio_id' => $request->ministerio_id,
        ];

        Culto::create($dados);
        return redirect()->route('reunioes', $request->ministerio_id)->with('mensagem','Aividade Registrada');
    }
}
