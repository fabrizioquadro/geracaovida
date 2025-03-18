<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('login/index');
    }

    public function esqueceu_senha(){
        return view('login/esqueceu_senha');
    }

    public function login(Request $request){
        $dados = $request->except('_token');
        if(Auth::attempt($dados)){
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }
        else{
            return redirect()->back()->with('erro', "Email ou senha inválidos");
        }
    }

    public function recuperar_senha(Request $request){
        //vamos verificar se existe esse email
        $user = User::where('email', $request->get('email'))->first();
        if($user){
            $novaSenha = createPassword(8, true, true, true, false);
            $user->password = bcrypt($novaSenha);
            $user->save();

            $mensagem = "
            <h4>Nova Senha de Acesso ao Sistema Gapp Serviço Inteligente</h4>
            <p>
                Foi alterado por sua solicitação a senha de acesso ao sistema.
            </p>
            <p>
                Sua nova senha é: $novaSenha
            </p>
            ";

            enviarMail($user->email, 'Nova Senha de Acesso', $mensagem);

            return redirect()->route('index')->with('mensagem','Sua nova senha foi enviado para o seu email.');
        }
        else{
            return redirect()->back()->with('erro', "Email inválido");
        }
    }

    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
