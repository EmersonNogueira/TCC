<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tema;


class ControladorTema extends Controller
{


    public function indexview(){
        return view('temas')>with('layout',"layout.app");;
    }
    public function store(Request $request)
    {
        
        $tema = new Tema();
        $tema->titulo = $request->input('titulo');
        $tema->descricao =$request->input('descricao');
        $tema->professor_id = $request->input('professor_id');
        $tema->save();
        $tema = Tema::find($tema->id);
        return json_encode($tema);
    }


    public function index()
    {
        $temas = Tema::with('professor')->get();
        return $temas->toJson();
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('novotema');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
