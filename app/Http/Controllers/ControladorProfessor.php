<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Professor;
use Illuminate\Support\Facades\Hash;
class ControladorProfessor extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        //$this->middleware('auth:professor');
    }


    public function viewalunos(){
        $alns = Aluno::all();
        return view('alunos',compact('alns'));
    }

    public function index()
    {
        $profs = Professor::all();

        return view('professors',compact('profs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('novoprofessor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = new Professor();
        $cat->nome = $request->input('nomeProfessor');
        $cat->cpf = $request->input('cpfProfessor');
        $cat->email = $request->input('emailProfessor');
        $cat->telefone = $request->input('numeroProfessor');
        $cat -> password =  Hash::make($request->input('password'));
        $cat->save();
        return redirect('/professores');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function professor(Request $id){
        $prof = Professor::find($id);

        if(isset($prof)){
            return ($id);
    
        }
    }

    public function edit($id)
    {
        $prof = Professor::find($id);
        if(isset($prof)){
            return view('editarprofessor', compact('prof'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prof = Professor::find($id);
        if(isset($prof)){
            $prof->nome = $request->input('nomeProfessor');
            $prof->email = $request->input('emailProfessor');
            $prof->telefone = $request->input('numeroProfessor');
            $prof->save();
        }
        return redirect('/professores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$prof = Professor::find($id);
        $prof = Professor::where('cpf', $id);
        if(isset($prof)){
            $prof->delete();
        }
        return response('ok',200);
    }

    public function indexjson(){
        $profs = Professor::all();
        return json_encode($profs);

    }
}
