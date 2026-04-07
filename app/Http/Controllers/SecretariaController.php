<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visita;
use App\Models\Membro;
use App\Models\User;
use App\Models\Reuniao;
use App\Models\Familia;
use App\Models\Culto;
use App\Models\Ministerio;
use App\Models\Reserva;

class SecretariaController extends Controller
{
    public function visitas(){
        $data = date('Y-m-d')." 00:00:00";
        $visitas = Visita::where('st_visita', '<>', 'Finalizada')->get();
        return view('secretaria/visitas/index', compact('visitas'));
    }

    public function adicionar(){
        $membros = Membro::all()->sortBy('nome');
        return view('secretaria/visitas/adicionar', compact('membros'));
    }

    public function insert(Request $request){
        $dados = $request->except('_token');
        $dados['st_visita'] = "Aberta";
        Visita::create($dados);

        return redirect()->route('secretaria.visitas')->with('mensagem','Visita Cadastrada!');
    }

    public function editar($id){
        $visita = Visita::where('id', $id)->first();
        $membros = Membro::all()->sortBy('nome');
        return view('secretaria/visitas/editar', compact('visita','membros'));
    }

    public function update(Request $request){
        $dados = $request->except('_token','visita_id','audio_base64');
        Visita::where('id', $request->visita_id)->update($dados);

        if($request->audio_base64){
            $visita = Visita::where('id', $request->visita_id)->first();
            $visita->audio_base64 = $request->audio_base64;
            $visita->save();
        }
        return redirect()->route('secretaria.visitas')->with('mensagem','Visita Editada!');
    }

    public function excluir($id){
        $visita = Visita::where('id', $id)->first();
        return view('secretaria/visitas/excluir', compact('visita'));
    }

    public function delete(Request $request){
        Visita::where('id', $request->visita_id)->delete();

        return redirect()->route('secretaria.visitas')->with('mensagem', 'Visita Excluída!');
    }

    public function visualizar($id){
        $visita = Visita::where('id', $id)->first();
        return view('secretaria/visitas/visualizar', compact('visita'));
    }

    public function atendimentos($id = null){
        $users = User::where('st_atendimento','Sim')->get();
        if($id){
            $user_agenda = User::where('id', $id)->first();
        }
        else{
            $user_agenda = null;
        }
        return view('secretaria/atendimentos/index', compact('users','user_agenda'));
    }

    public function listar_eventos_user($id = null){
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
            ->orderBy('dt_hr_reuniao')
            ->get();

            foreach($reunioes as $reuniao){
                //vamos ver se tem espaço vago do horario até a ageda
                if(strtotime($reuniao->dt_hr_reuniao) > strtotime($dt_hr_inc)){
                    $eventos[] = [
                        'id' => "Livre,$user->id,".$dt_hr_inc.",".$reuniao->dt_hr_reuniao,
                        'title' => "Livre",
                        'start' => $dt_hr_inc,
                        'end' => $reuniao->dt_hr_reuniao,
                        'color' => '#00FF00'
                    ];

                    $dt_hr_inc = $reuniao->dt_hr_reuniao;
                }

                $dt_hr_final_reuniao = date('Y-m-d H:i:s', strtotime("+$reuniao->tempo_reuniao minutes", strtotime($dt_hr_inc)));
                if($reuniao->st_reuniao == "Finalizada"){
                    $color = "#CDCDCD";
                }
                else{
                    $color = "#FFFF00";
                }

                if($reuniao->tp_reuniao == "Individual"){
                    $title = $reuniao->membro->nome;
                }
                elseif($reuniao->tp_reuniao == "Casal"){
                    $title = $reuniao->familia->pai()->nome." & ".$reuniao->familia->mae()->nome;
                }
                else{
                    $title = "";
                }

                $eventos[] = [
                    'id' => "Reuniao,$reuniao->id",
                    'title' => $title,
                    'start' => $dt_hr_inc,
                    'end' => $dt_hr_final_reuniao,
                    'color' => $color
                ];
                $dt_hr_inc = $dt_hr_final_reuniao;
            }

            if(strtotime($dt_hr_inc) < strtotime($dt_hr_fn)){
                $eventos[] = [
                    'id' => "Livre,$user->id,".$dt_hr_inc.",".$dt_hr_fn,
                    'title' => "Livre",
                    'start' => $dt_hr_inc,
                    'end' => $dt_hr_fn,
                    'color' => '#00FF00'
                ];
            }

            $data = date('Y-m-d', strtotime('+1 day', strtotime($data)));
        }

        echo json_encode($eventos);
    }

    public function adicionar_atendimento($user_id = null, $inc = null, $fn = null){
        $user = User::where('id', $user_id)->first();
        $membros = Membro::all()->sortBy('nome');
        $familias = Familia::all();

        $var = explode(' ', $inc);
        $data = $var[0];
        $inc = $var[1];

        $var = explode(' ', $fn);
        $fn = $var[1];

        return view('secretaria/atendimentos/adicionar_atendimento', compact('user','inc','fn','membros','familias','data'));
    }

    public function insert_atendimento(Request $request){
        $dados = [
            'user_id' => $request->user_id,
            'familia_id' => $request->familia_id,
            'membro_id' => $request->membro_id,
            'tp_reuniao' => $request->tp_reuniao,
            'dt_hr_reuniao' => $request->data." ".$request->hr_inc,
            'ds_reuniao' => $request->ds_reuniao,
            'tempo_reuniao' => $request->tempo_reuniao,
            'st_reuniao' => 'Aberta',
        ];

        Reuniao::create($dados);
        return redirect()->route('secretaria.atendimentos', $request->user_id)->with('mensagem','Atendimento Cadastrado!');
    }

    public function editar_atendimento($id = null){
        $reuniao = Reuniao::where('id', $id)->first();

        $var = explode(' ', $reuniao->dt_hr_reuniao);
        $data = $var[0];
        $hora = $var[1];

        $user = User::where('id', $reuniao->user_id)->first();
        $membros = Membro::all()->sortBy('nome');
        $familias = Familia::all();

        return view('secretaria/atendimentos/editar_atendimento', compact('reuniao','user',
        'membros','familias','data','hora'));
    }

    public function update_atendimento(Request $request){
        $reuniao = Reuniao::where('id', $request->reuniao_id)->first();
        $reuniao->familia_id = $request->familia_id;
        $reuniao->membro_id = $request->membro_id;
        $reuniao->tp_reuniao = $request->tp_reuniao;
        $reuniao->dt_hr_reuniao = $request->data." ".$request->hr_inc;
        $reuniao->tempo_reuniao = $request->tempo_reuniao;
        $reuniao->ds_reuniao = $request->ds_reuniao;

        $reuniao->save();
        return redirect()->route('secretaria.atendimentos', $reuniao->user_id)->with('mensagem','Atendimento Editado!');
    }

    public function delete_atendimento($id){
        $reuniao = Reuniao::where('id', $id)->first();
        $reuniao->delete();
        return redirect()->route('secretaria.atendimentos', $reuniao->user_id)->with('mensagem','Atendimento Excluído!');
    }

    public function atividades(){
        $atividades = Culto::where('tp_culto', 'Atividade')->get();
        return view('secretaria/atividades/index', compact('atividades'));
    }

    public function adicionar_atividade(){
        $ministerios = Ministerio::where('st_reuniao', 'Sim')->get();
        return view('secretaria/atividades/adicionar', compact('ministerios'));
    }

    public function insert_atividade(Request $request){
        $dados = [
            'nm_culto' => $request->nm_culto,
            'dt_hr_culto' => $request->dt_culto." ".$request->hr_culto,
            'ds_culto' => $request->ds_culto,
            'st_culto' => 'Aberto',
            'tp_culto' => 'Atividade',
            'nr_vagas' => $request->nr_vagas,
            //'ministerio_id' => $request->ministerio_id,
        ];
        $culto = Culto::create($dados);
        $culto->ministerios()->sync($request->ministerio_id);
        return redirect()->route('secretaria.atividades')->with('mensagem','Atividade Cadastrada!');
    }

    public function editar_atividade($id){
        $culto = Culto::where('id', $id)->first();
        $var = explode(' ', $culto->dt_hr_culto);
        $data = $var[0];
        $hora = $var[1];
        $ministerios = Ministerio::where('st_reuniao', 'Sim')->get();
        return view('secretaria/atividades/editar', compact('ministerios','culto','data','hora'));
    }

    public function update_atividade(Request $request){
        $culto = Culto::where('id', $request->culto_id)->first();
        $culto->dt_hr_culto = $request->dt_culto." ".$request->hr_culto;
        //$culto->ministerio_id = $request->ministerio_id;
        $culto->nm_culto = $request->nm_culto;
        $culto->ds_culto = $request->ds_culto;
        $culto->nr_vagas = $request->nr_vagas;

        $culto->save();
        $culto->ministerios()->sync($request->ministerio_id);
        return redirect()->route('secretaria.atividades')->with('mensagem','Atividade Editada!');
    }

    public function excluir_atividade($id){
        $culto = Culto::where('id', $id)->first();
        return view('secretaria.atividades.excluir', compact('culto'));
    }

    public function delete_atividade(Request $request){
        $culto = Culto::where('id', $request->culto_id)->first();
        $culto->ministerios()->sync([]);
        $culto->delete();
        return redirect()->route('secretaria.atividades')->with('mensagem','Atividade Excluída!');
    }

    public function reservas($id){
        $atividade = Culto::where('id', $id)->first();
        return view('secretaria/atividades/reservas', compact('atividade'));
    }

    public function setar_reserva(){
        if($_GET['tipo'] == 'membro'){
            $dados = [
                'culto_id' => $_GET['atividade_id'],
                'membro_id' => $_GET['membro_id'],
                'tp_reserva' => 'Membro',
            ];

            if($_GET['acao'] == "inserir"){
                Reserva::create($dados);
            }
            else{
                Reserva::where($dados)->delete();
            }
        }
    }

    public function reservas_set_convite(Request $request){
        $dados = [
            'culto_id' => $request->atividade_id,
            'tp_reserva' => 'convite',
            'nm_convite' => $request->nm_convite,
        ];

        Reserva::create($dados);
        return redirect()->route('secretaria.atividades.reservas', $request->atividade_id);
    }

    public function reservas_delete_convite($id = null){
        $reserva = Reserva::where('id', $id)->first();
        $reserva->delete();
        return redirect()->route('secretaria.atividades.reservas', $reserva->culto_id);
    }

}
