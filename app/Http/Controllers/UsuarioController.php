<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ministerio;

class UsuarioController extends Controller
{
    public function index(){
        $users = User::all();
        return view('usuarios/index', compact('users'));
    }

    public function adicionar(){
        $ministerios = Ministerio::all()->sortBy('nm_ministerio');
        return view('usuarios/adicionar', compact('ministerios'));
    }

    public function insert(Request $request){
        $dados = $request->except('_token','imagem','password','ministerios');
        $dados['password'] = bcrypt($request->get('password'));
        $user = User::create($dados);
        $user->ministerios()->sync($request->get('ministerios'));

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $user->id.".".$extensao;
            $request->imagem->move(public_path('img/users'), $nmImagem);

            $user->imagem = $nmImagem;
            $user->save();

        }

        return redirect()->route('usuarios')->with('mensagem', 'Usuário Cadastrado!');
    }

    public function editar($id){
        $user = User::where('id', $id)->first();

        $ministerios = Ministerio::all()->sortBy('nm_ministerio');
        return view('usuarios/editar', compact('user','ministerios'));
    }

    public function update(Request $request){
        $dados = $request->except('_token','imagem','user_id','ministerios');
        $user_id = $request->get('user_id');

        User::where('id', $user_id)->update($dados);
        $user = User::where('id', $user_id)->first();
        $user->ministerios()->sync($request->get('ministerios'));

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $user->id.".".$extensao;
            $request->imagem->move(public_path('img/users'), $nmImagem);

            $user->imagem = $nmImagem;
            $user->save();

        }

        return redirect()->route('usuarios')->with('mensagem', 'Usuário Editado!');
    }

    public function alterar_senha($id){
        $user = User::where('id', $id)->first();

        return view('usuarios/alterar_senha', compact('user'));
    }

    public function alterar_senha_update(Request $request){
        $user = User::where('id', $request->get('user_id'))->first();
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return redirect()->route('usuarios')->with('mensagem', 'Senha Alterada!');
    }

    public function excluir($id){
        $user = User::where('id', $id)->first();

        return view('usuarios/excluir', compact('user'));
    }

    public function delete(Request $request){
        $user = User::where('id', $request->get('user_id'))->first();
        $user->ministerios()->sync([]);
        $user->delete();

        return redirect()->route('usuarios')->with('mensagem', 'Usuário Excluído!');
    }
}
