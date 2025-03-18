<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reuniao;
use App\Models\ReuniaoPresenca;
use App\Models\Membro;
use App\Models\Familia;

class AgendaController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('agendas/index', compact('user'));
    }

    public function listar_eventos($id = null){
        $user = User::where('id', $id)->first();
        $eventos = [];

        $data = date('Y-m-d');
        for($i = 0 ; $i<60 ; $i++){
            //vamos começar com o horario demanha
            $dt_hr_inc = $data." "."08:00:00";
            $dt_hr_fn = $data." "."23:00:00";

            $reunioes = Reuniao::where('user_id', $user->id)
            ->where('dt_hr_reuniao','>=',$dt_hr_inc)
            ->where('dt_hr_reuniao','<=',$dt_hr_fn)
            ->where('st_reuniao','Aberta')
            ->orderBy('dt_hr_reuniao')
            ->get();

            foreach($reunioes as $reuniao){
                $dt_hr_final_reuniao = date('Y-m-d H:i:s', strtotime("+$reuniao->tempo_reuniao minutes", strtotime($reuniao->dt_hr_reuniao)));

                if($reuniao->tp_reuniao == "Casal"){
                    $title = $reuniao->familia->pai()->nome." & ".$reuniao->familia->mae()->nome;
                }
                elseif($reuniao->tp_reuniao == "Individual"){
                    $title = $reuniao->membro->nome;
                }
                else{
                    $title = "";
                }

                $eventos[] = [
                    'id' => "Reuniao,$reuniao->id",
                    'title' => $title,
                    'start' => $reuniao->dt_hr_reuniao,
                    'end' => $dt_hr_final_reuniao,
                    'color' => "#FFFF00"
                ];
            }

            $data = date('Y-m-d', strtotime('+1 day', strtotime($data)));
        }

        echo json_encode($eventos);
    }

    public function acessar_reuniao($id = null){
        $reuniao = Reuniao::where('id', $id)->first();

        if($reuniao->tp_reuniao == 'Individual'){
            $membros = Membro::where('id', $reuniao->membro_id)->get();
        }
        elseif($reuniao->tp_reuniao == 'Casal'){
            $familia = Familia::where('id', $reuniao->familia_id)->first();
            $in = array();
            if($familia->pai_id){
                $in[] = $familia->pai_id;
            }
            if($familia->mae_id){
                $in[] = $familia->mae_id;
            }

            $membros = Membro::whereIn('id', $in)->orderBy('nome')->get();
        }

        return view('agendas/acessar_agenda', compact('membros','reuniao'));
    }

    public function acessar_reuniao_set(Request $request){
        //dd($request);
        $reuniao = Reuniao::where('id', $request->reuniao_id)->first();
        $reuniao->ds_parecer = $request->ds_parecer;
        $reuniao->st_reuniao = 'Finalizada';
        $reuniao->audio_base64 = $request->audio_base64;
        $reuniao->save();

        foreach($request->presenca as $membro_id){
            $dados = [
                'reuniao_id' => $reuniao->id,
                'membro_id' => $membro_id,
            ];
            ReuniaoPresenca::create($dados);
        }

        return redirect()->route('agendas')->with('mensagem', 'Atendimento Finalizada');
    }

    public function lista_atendimentos(){
        $user = auth()->user();
        $reunioes = Reuniao::where('user_id', $user->id)->get();

        return view('agendas/listar_atendimentos', compact('user','reunioes'));
    }
}
