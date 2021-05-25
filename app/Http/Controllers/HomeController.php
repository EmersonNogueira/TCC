<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use App\Aluno;
use App\Tema;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewtemas()
    {
        $temas = Tema::all();
        return view('temas',compact('temas'))->with('layout',"layout.app");

        
        
    }

    public function viewprofessores(){
        $profs = Professor::all();

        return view('professors',compact('profs'));    
    }

    public function viewalunos(){
        $alns = Aluno::all();
        return view('alunos',compact('alns'));
    }

}
