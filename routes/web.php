<?php

use Illuminate\Support\Facades\Route;
use App\Tema;
use App\Professor;


Route::get('/', function () {
    return view('index');
});

Route::get('/trabalhos', 'TrabalhoControlador@index');
Route::post('/trabalho', 'TrabalhoControlador@store');
Route::delete('/trabalho/{id}', 'TrabalhoControlador@destroy');
Route::get('/trabalho/download/{id}', 'TrabalhoControlador@download');


Route::get('/aluno/login','Auth\AlunoLoginController@index')->name('aluno.login');
Route::post('/aluno/login','Auth\AlunoLoginController@login')->name('aluno.login.submit');

Route::get('/prof','ProfessorController@index');

Route::get('/prof/login','Auth\ProfessorLogin@index')->name('prof.login');
Route::post('/prof/login','Auth\ProfessorLogin@login')->name('prof.login.submit');



Route::post('/tema/professor','ControladorProfessor@professor');




Route::get('/alunos','ControladorAluno@indexview');

Route::get('/alunos/inicio','ControladorAluno@login')->name('homealuno');


Route::get('/professores','ControladorProfessor@index')->name('homeprofessor');

Route::get('/temas','ControladorTema@indexview');

Route::get('/professores/novo','ControladorProfessor@create');

Route::post('/professores','ControladorProfessor@store');

Route::delete('/professores/apagar/{id}', 'ControladorProfessor@destroy');

Route::get('/professores/editar/{id}', 'ControladorProfessor@edit');

Route::post('/professores/{id}', 'ControladorProfessor@update');

Route::get('/professor/alunos','ControladorProfessor@viewalunos');




Auth::routes();

Route::get('/home', 'HomeController@viewprofessores')->name('home');

Route::get('/admin/professores', 'HomeController@viewprofessores');

Route::get('/admin/alunos', 'HomeController@viewalunos')->middleware(['auth:web']);

Route::get('/admin/temas', 'HomeController@viewtemas');



Route::get('/xxx', function () {
    $temas = Tema::all();
    if(count($temas)==0)
        echo "<h4>Nao tem tema cadastrado</h4>";
    else{
        foreach($temas as $p){
            echo "<p>".$p->id. " - ". $p->titulo. " - ". $p->descricao. " Professor ". $p->professor->nome . "</p>";
        }
    }
});

Route::get('/bdt', function () {
    $temas = Tema::with('professor')->get();

    if(count($temas)==0)
        echo "<h4>Nao tem tema cadastrado</h4>";
    else{
        foreach($temas as $p){
            echo "<p>".$p->id. " - ". $p->titulo. " - ". $p->descricao. " Professor ". $p->professor->nome . "</p>";
        }
    }
    return $temas->toJson();
});


Route::get('/bdp', function () {
    $professores = Professor::all();
    if(count($professores)==0)
        echo "<h4>Nao tem professor cadastrado</h4>";
    else{
        foreach($professores as $p){
            echo "<p>".$p->id. "-". $p->nome. "</p>";
            $temas = $p->temas;
            foreach($temas as $t){
                echo "<li>". $t->titulo."</li>";            
            } 
        }
    }
});