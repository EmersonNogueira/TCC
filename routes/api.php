<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:aluno-api')->get('/aluno', function (Request $request) {
    return $request->aluno();
});

Route::get('/professores','ControladorProfessor@indexjson');
Route::resource('/alunos', 'ControladorAluno');
Route::resource('/temas', 'ControladorTema');
