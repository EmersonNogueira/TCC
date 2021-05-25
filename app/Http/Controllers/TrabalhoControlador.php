<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trabalho;
use Illuminate\Support\Facades\Storage;

class TrabalhoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabalhos = Trabalho::all();
        return view('trabalhos',compact(['trabalhos']));
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
        $path = $request->file('arquivo')->store('pdfs','public');
        $trabalho = new Trabalho();
        $trabalho->email = $request->input('email');
        $trabalho->nome = $request->input('nome');
        $trabalho->titulo = $request->input('titulo');
        $trabalho->resumo = $request->input('resumo');
        $trabalho->arquivo = $path;//$request->input('arquivo');
        $trabalho->save();
        return redirect('/trabalhos');

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

    public function download($id){
        
        $trabalho = Trabalho::find($id);

        if(isset($trabalho)){
            $path = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($trabalho->arquivo);
            return response()->download($path);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trabalho = Trabalho::find($id);
        if(isset($trabalho)){
            $arquivo = $trabalho->arquivo;
            Storage::disk('public')->delete($arquivo);
            $trabalho->delete();
        }
        
        return redirect('/trabalhos');
    }
}
