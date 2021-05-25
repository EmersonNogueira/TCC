<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;

class AlunoLoginController extends Controller
{

    public function __construct() {
        $this->middleware('guest:aluno');
        // somente quem não estiver logado como aluno terá acesso ao login
    }
    public function login(Request $request){
        // validar o dado que vem do formulario
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // tentar logar
        $credentials = [ 'email'=> $request->email,'password' => $request->password ];
        $authOk = Auth::guard('aluno')->attempt($credentials, $request->remember); // ==> assim eu utilizo o guard do aluno
        if($authOk){
            return redirect()->intended(route('homealuno'));

        }
        //return redirect()->withInputs($request)->only('email','remember');
        return redirect()->back()->withInput($request->only('email','remember'));


    }
    public function index() {
        return view('auth.aluno-login');
    }
}
