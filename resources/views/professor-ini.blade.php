@extends('layouts.app')
@section('content')
<div class="container">
</div>
@endsection

@extends('layout.app',["corrent" => "temas"])
@section('body')
    <h4> Pagina de Temas </h4>
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Alunos</h5>
            <table class="table table-ordered table-hover" id="tabelaTemas">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Professor Orientador</th>
                        <th>Titulo</th>
                        <th>Descricao</th>
                        <th>Acoes</th>
                    </tr>
                    <tbody>
                    </tbody>
                </thead>
            </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" role="button" onclick="novoTema()">Cadastrar Tema</a>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="dlgTemas">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formTema">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Tema</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class="form-group">
                            <label for="cpfProfessor" class="control-label">CPF Professor</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="cpfProfessor" placeholder='CPF Professor'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="titulo" class="control-label">Titulo</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="titulo" placeholder='Titulo'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descricao" class="control-label">Descricao</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="descricao" placeholder='descricao'>
                            </div>
                        </div>
                     
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="cancel" class="btn btn-secondary">Cancelar</button>                    
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':"{{ csrf_token() }}"

            }
        });
        function novoTema(){
            $('#cpfProfessor').val('')
            $('#titulo').val('')
            $('#descricao').val('')
            $('#dlgTemas').modal('show')
           
            
        }
        function carregarProfessores() {
            $.getJSON('/api/professores', function(data) { 
                for(i=0;i<data.length;i++) {
                    opcao = '<option value ="' + data[i].nome + '">' + 
                    data[i].nome + '</option>';
                    $('#professorAluno').append(opcao);
                }
            });
        }

        function montarlinha(tema){
            var linha = "<tr>"+
                "<td>" + tema.id + "</td>"+ 
                "<td>" + tema.cpfProfessor + "</td>"+ 
                "<td>" + tema.titulo + "</td>"+ 
                "<td>" + tema.descricao + "</td>"+
                "<td>"+
                    '<button class="btn btn-sm btn-primary" onclick="editar('+tema.id+')">Editar</button>'+
                    '<button class="btn btn-sm btn-danger"  onclick="remover('+tema.id+')">Apagar </button> ' +
                "</td>"+
            "</tr>"
            return linha;
            
        }
        function editar(id){
            $.getJSON('/api/temas/'+id, function(data) {
                console.log(data);
                $('#id').val(data.id);
                //$('#cpfprofessor') .val(data.cpf);
                $('#nomeAluno').val(data.titulo);
                $('#descricao').val('data.descrecao');
                $('#dlgAlunos').modal('show');     
            });     


        }

        function remover(id){
            $.ajax({
                type:"DELETE",
                url: "/api/temas/"+id,
                context: this,
                success: function(){
                    console.log('apagou'); 
                    linhas = $("#tabelaTemas>tbody>tr");
                    e = linhas.filter( function(i, elemento) { 
                    return elemento.cells[0].textContent == id; 
                });
                if (e)
                    e.remove();                    
                },
                error:function(error){
                    console.log("DEU error");

                }
            });
        }



        function carregarTemas(){
            $.getJSON('/api/temas', function(temas){
                for (i=0;i<temas.length;i++){
                    linha = montarlinha(temas[i])
                    $('#tabelaTemas>tbody').append(linha)
                    console.log(temas[i]);
                }
            });
        }
        function criarTema(){
            t = {   
                //id:$('#id').val(),
                cpf:$("#cpfProfessor").val(),
                titulo:$("#titulo").val(),
                descricao:$("#descricao").val()

            };
            $.post("/api/temas",t,function(data){
                tema = JSON.parse(data);
                linha = montarlinha(tema);
                console.log(data);
                $('#tabelaTemastbody').append(linha); 
            });
        }

        function logout(){
            $.post("/logout")
        }
            
        function salvarAluno(){                
            tema = {   
                id : $("#id").val(), 
                cpf: parseInt($("#cpfProfessor").val()),
                titulo:$("titulo").val(),
                descricao: $("#descricao").val()
            };
            console.log(aluno)
            $.ajax({
                type: "PUT",
                url: "/api/temas/" + tema.id,
                context: this,
                data: tema,
                success: function(data) {
                    t = JSON.parse(data);
                    linhas = $('#tabelaTemas>tbody>tr');
                    console.log(t);
                    console.log(linhas);
                    e = linhas.filter( function(i, e) { 
                        return ( e.cells[0].textContent == aln.id );
                    });
                    if(e){
                        e[0].cells[0].textContent = t.id;
                        //e[0].cells[1].textContent = t.cpf;
                        e[0].cells[2].textContent = t.titulo;
                        e[0].cells[3].textContent = t.descricao;
                    }
                        
                },
                error:function(error){

                }
            });
        }

        $("#formAluno").submit(function(event){
            event.preventDefault();
            if ($("#id").val() != ''){ 
                    console.log($("#id").val());
                    console.log('diferente')
                    salvarTema();
                }
                else{
                    console.log('aqui')
                    
                    criarTema();                    
                } 
                $("#dlgTemas").modal('hide');
        });
        
        $(function(){
            
            carregarTemas();
        })
    
    </script>
@endsection
