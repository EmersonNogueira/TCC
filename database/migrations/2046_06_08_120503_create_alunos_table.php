<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('cpf');
            $table->string('nome');
            $table->string('email')->unique();
            $table->integer('semestre');
            $table->integer('tema_id')->unsigned()->nullable();
            $table->foreign('tema_id')->references('id')->on('temas');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
