<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Aluno;
class ControladorAluno extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        //$this->middleware(['web','auth:aluno']);
    }

    public function login(){
        return view('temas')->with('layout',"layout.appaluno");
    }

    public function indexview()
    {
        return view('alunos');
    }
    public function index()
    {
        $alns = Aluno::all();
        return $alns->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aln = new Aluno();
        $aln -> cpf = $request->input('cpf');
        $aln -> nome = $request->input('nome');
        $aln -> semestre = $request->input('semestre');  
        $aln -> email = $request->input('email');
        $aln -> password =  Hash::make($request->input('password'));
        //$aln -> tema_id = $request->input('professorAluno');
        $aln ->save();
        return json_encode($aln);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aln = Aluno::where('id',$id)->first();
        if (isset($aln)) {
            return json_encode($aln);            
            
        }
        return response('Aluno não encontrado', 404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $aln = Aluno::where('id',$id)->first();
        
        if(isset($aln)){
            $aln -> nome = $request->input('nome');
            $aln -> semestre = $request->input('semestre');
            $aln -> save(); 
            return json_encode($aln);
   
        }
        return response('nao encontrou',404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $aln = Aluno::where('cpf', $id);
        if(isset($aln)){
            $aln->delete();
            return response('ok',200);
        }
        return response('Produto nao encotrado',404);

    }
}