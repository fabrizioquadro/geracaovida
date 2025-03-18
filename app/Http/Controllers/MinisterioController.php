<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ministerio;
use App\Models\MinisterioGenero;

class MinisterioController extends Controller
{
    public $generos = ['Homem','Mulher','Casal','Jovem','Adolescente',
    'Pré-adolescente','Criança','Infantil A','Infantil B','Berçário'];

    public function index(){
        $ministerios = Ministerio::all();
        return view('ministerios/index', compact('ministerios'));
    }

    public function adicionar(){
        //$generos = $this->generos;
        return view('ministerios/adicionar');
    }

    public function insert(Request $request){
        $dados = $request->except('_token','generos');
        $ministerio = Ministerio::create($dados);
        /*
        foreach($request->generos as $genero){
            $dados = [
                'ministerio_id' => $ministerio->id,
                'genero' => $genero,
            ];
            MinisterioGenero::create($dados);
        }
        */
        return redirect()->route('ministerios')->with('mensagem','Ministério Cadastrado!');
    }

    public function editar($id){
        $ministerio =  Ministerio::where('id', $id)->first();
        //$generos = $this->generos;
        return view('ministerios/editar', compact('ministerio'));
    }

    public function update(Request $request){
        $dados = $request->except('_token','ministerio_id');
        Ministerio::where('id', $request->get('ministerio_id'))->update($dados);
        $ministerio = Ministerio::where('id', $request->ministerio_id)->first();

        /*
        MinisterioGenero::where('ministerio_id', $ministerio->id)->delete();
        foreach($request->generos as $genero){
            $dados = [
                'ministerio_id' => $ministerio->id,
                'genero' => $genero,
            ];
            MinisterioGenero::create($dados);
        }
        */

        return redirect()->route('ministerios')->with('mensagem','Ministério Editado!');
    }

    public function excluir($id){
        $ministerio =  Ministerio::where('id', $id)->first();

        return view('ministerios/excluir', compact('ministerio'));
    }

    public function delete(Request $request){
        MinisterioGenero::where('ministerio_id', $request->ministerio_id)->delete();
        Ministerio::where('id', $request->get('ministerio_id'))->delete();

        return redirect()->route('ministerios')->with('mensagem','Ministério Excluído!');
    }
}
