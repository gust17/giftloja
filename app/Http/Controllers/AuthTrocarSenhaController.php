<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthTrocarSenhaController extends Controller
{

    public function index()
    {
        //dd('oi');
        $page = "Alteracao de Senha";
        return view('auth.trocar-senha',compact('page'));
    }

    public function salvarNovaSenha(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->senha_alterada = true;
        $user->save();

        Session::flash('mensagem', 'Sua senha foi atualizada com sucesso');

        return redirect()->route('dashboard');



    }
}
