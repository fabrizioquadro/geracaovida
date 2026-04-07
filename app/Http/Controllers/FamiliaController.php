<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Familia;
//use App\Models\FamiliaFilho;
use App\Models\Membro;

class FamiliaController extends Controller
{
    public function index(){
        $familias = Familia::all();

        return view('familias/index', compact('familias'));
    }

    public function adicionar(){
        $pais = Membro::where('genero', 'Masculino')->orderBy('nome')->get();
        $maes = Membro::where('genero', 'Feminino')->orderBy('nome')->get();
        $criancas = Membro::where('genero', 'Criança')->orderBy('nome')->get();
        return view('familias/adicionar', compact('pais','maes','criancas'));
    }

    public function insert(Request $request){
        $dados_familia = [
            'pai_id' => $request->get('pai_id'),
            'mae_id' => $request->get('mae_id'),
        ];

        $familia = Familia::create($dados_familia);

        for($i=1 ; $i<=$request->get('contador_filhos') ; $i++){
            $var = "filho_".$i;
            if($request->get($var)){
                $dados = [
                    'familia_id' => $familia->id,
                    'filho_id' => $request->get($var),
                ];
                FamiliaFilho::create($dados);
            }
        }
        return redirect()->route('familias')->with('mensagem', 'Família Adicionada!');

    }

    public function editar($id){
        $familia = Familia::where('id', $id)->first();
        $pais = Membro::where('genero', 'Masculino')->orderBy('nome')->get();
        $maes = Membro::where('genero', 'Feminino')->orderBy('nome')->get();
        $criancas = Membro::where('genero', 'Criança')->orderBy('nome')->get();
        return view('familias/editar', compact('familia','pais','maes','criancas'));
    }

    public function excluir_filho(){
        $filho = Membro::where('id', $_GET['filho_id'])->first();
        $dados = [
            'familia_id' => $_GET['familia_id'],
            'filho_id' => $filho->id,
        ];
        FamiliaFilho::where($dados)->delete();
        $retorno['controle'] = 'true';
        $retorno['filho_id'] = $filho->id;

        echo json_encode($retorno);
    }

    public function update(Request $request){
        $familia = Familia::where('id', $request->get('familia_id'))->first();
        $familia->pai_id = $request->get('pai_id');
        $familia->mae_id = $request->get('mae_id');
        $familia->save();

        for($i=1 ; $i<=$request->get('contador_filhos') ; $i++){
            $var = "filho_".$i;
            if($request->get($var)){
                $dados = [
                    'familia_id' => $familia->id,
                    'filho_id' => $request->get($var),
                ];
                FamiliaFilho::create($dados);
            }
        }
        return redirect()->route('familias')->with('mensagem', 'Família Editada!');
    }

    public function excluir($id){
        $familia = Familia::where('id', $id)->first();
        return view('familias/excluir', compact('familia'));
    }

    public function delete(Request $request){
        $familia = Familia::where('id', $request->get('familia_id'))->first();
        FamiliaFilho::where('familia_id', $familia->id)->delete();
        $familia->delete();

        return redirect()->route('familias')->with('mensagem','Família Excluída!');
    }

    public function visualizar($id){
        $familia = Familia::where('id', $id)->first();
        return view('familias/visualizar', compact('familia'));
    }

}
