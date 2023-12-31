<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function username()
    {
        return 'cpf';
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = 'dashboard';
    public function authenticated(Request $request, $user)
    {
        if (!$user->senha_alterada) {
            $user->senha_alterada = true;
            $user->save();
            return redirect()->route('trocar-senha');
        }

        return redirect()->intended($this->redirectPath());
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */



}
