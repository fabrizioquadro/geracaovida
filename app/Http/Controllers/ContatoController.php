<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membro;
use App\Models\Contato;

class ContatoController extends Controller
{
    public function index(){
        $membros = Membro::all();
        return view('contatos/index', compact('membros'));
    }

    public function view($id){
        $membro = Membro::where('id', $id)->first();
        $contatos = Contato::where('membro_id', $membro->id)->orderByDesc('dt_hr_contato')->get();
        return view("contatos/view", compact('membro','contatos'));
    }

    public function insert(Request $request){
        $dados = [
            'membro_id' => $request->get('membro_id'),
            'dt_hr_contato' => $request->get('data')." ".$request->hora,
            'ds_contato' => $request->ds_contato,
            'audio_base64' => $request->audio_base64,
            'user_id' => auth()->user()->id,
        ];
        Contato::create($dados);
        return redirect()->route('contatos.view', $request->membro_id)->with('mensagem','Contato Cadastrado!');
    }
}
