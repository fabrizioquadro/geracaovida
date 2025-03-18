<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard/index');
    }

    public function perfil(){
        $user = Auth::user();
        return view('dashboard/perfil', compact('user'));
    }

    public function perfil_update(Request $request){
        $user = Auth::user();
        $user->nm_usuario = $request->get('nm_usuario');
        $user->email = $request->get('email');
        $user->ds_genero = $request->get('ds_genero');
        $user->save();

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $user->id.".".$extensao;
            $request->imagem->move(public_path('img/users'), $nmImagem);

            $user->imagem = $nmImagem;
            $user->save();

        }
        return redirect()->route('perfil')->with('mensagem', 'Perfil Atualizado!');
    }

    public function alterar_senha(){
        return view('dashboard/alterar_senha');
    }

    public function alterar_senha_update(Request $request){
        $user = auth()->user();
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect()->route('perfil')->with('mensagem', 'Senha Atualizado!');
    }
}
