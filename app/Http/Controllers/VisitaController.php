<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visita;
use App\Models\User;

class VisitaController extends Controller
{
    public function index(){
        $visitas = Visita::all();
        return view('visitas/index', compact('visitas'));
    }

    public function agendamento($id){
        $visita = Visita::where('id',$id)->first();
        $users = User::all()->sortBy('nm_usuario');
        return view('visitas/agendamento', compact('visita','users'));
    }

    public function acessar($id){
        $visita = Visita::where('id',$id)->first();
        $users = User::all()->sortBy('nm_usuario');
        return view('visitas/acessar', compact('visita','users'));
    }

    public function agendamento_set(Request $request){
        $visita = Visita::where('id', $request->visita_id)->first();
        $visita->user_id = $request->user_id;
        $visita->dt_hr_visita = $request->data." ".$request->hora;
        $visita->st_visita = "Agendada";
        $visita->save();

        return redirect()->route('visitas')->with('mensagem', 'Agendamento Cadastrado!');
    }

    public function feedback_set(Request $request){
        $visita = Visita::where('id', $request->visita_id)->first();
        $visita->ds_resumo = $request->ds_resumo;
        $visita->st_visita = 'Finalizada';
        $visita->audio_base64 = $request->audio_base64;
        $visita->save();

        if($request->hasFile('audio_whats') && $request->file('audio_whats')->isValid()){
            $audio = $request->audio_whats;
            $extensao = $audio->extension();

            $nm_audio = $visita->id.".".$extensao;
            $request->audio_whats->move(public_path('audio/visitas'), $nm_audio);

            $visita->audio_whats = $nm_audio;
            $visita->save();

        }

        return redirect()->route('visitas')->with('mensagem', 'Visita Finalizada!');
    }
}
