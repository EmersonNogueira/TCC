<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfessorLogin extends Controller
{
    public function __construct() {
        $this->middleware('guest:professor');
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
        $authOk = Auth::guard('professor')->attempt($credentials, $request->remember); // ==> assim eu utilizo o guard do professor
        if($authOk){
            return redirect()->intended(route('homeprofessor'));

        }
        //return redirect()->withInputs($request)->only('email','remember');
        return redirect()->back()->withInput($request->only('email','remember'));
        


    }
    public function index() {
        return view('auth.login-professor');
    }

}
