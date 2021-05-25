@extends('layouts.app')
@extends('layout.app', ["corrent" => "alunos"])
@section('body')
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Alunos</h5>
        <table class="table table-ordered table-hover" id="tabelaAlunos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CPF</th>
                    <th>Nome do aluno</th>
                    <th>Semestre</th>
                    <th>Tema</th>
                    <th>Acoes</th>
                </tr>
                <tbody>
                </tbody>
            </thead>
        </table>
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onclick="novoAluno()">Cadastrar aluno</a>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="dlgAlunos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formAluno">
                <div class="modal-header">
                    <h5 class="modal-title">Novo aluno</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="nomeAluno" class="control-label">Nome do aluno</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nomeAluno" placeholder='nome do aluno'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cpfAluno" class="control-label">CPF do aluno</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cpfAluno" placeholder='CPF do aluno'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="semestreAluno" class="control-label">Semestre do aluno</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="semestreAluno" placeholder='semestre do aluno'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="professorAluno" class="control-label">Professor</label>
                        <div class="input-group">
                            <select class="form-control" id="professorAluno"></select>
                        </div>
                    </div>

                    <label for="emailAluno">EMAIL</label>
                    <input type="email" class="form-control" name="emailAluno" id="emailAluno">
                    <div class="form-group">
                        <label for="password" class="control-label">Nova senha</label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        </div>    
                    </div>
        
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>                    
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
        function novoAluno(){
            $('#nomeAluno').val('')
            $('#semestreAluno').val('')
            $('#cpfAluno').val('')
            $('#password').val('')
            $('#emailAluno').val('')
            $('#dlgAlunos').modal('show')
           
            
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

        function montarlinha(al){
            var linha = "<tr>"+
                "<td>" + al.id + "</td>"+ 
                "<td>" + al.cpf + "</td>"+ 
                "<td>" + al.nome + "</td>"+ 
                "<td>" + al.semestre + "</td>"+
                "<td>"+  al.tema_id +  "</td>"+
                "<td>"+
                    '<button class="btn btn-sm btn-primary" onclick="editar('+al.id+')">Editar</button>'+
                    '<button class="btn btn-sm btn-danger"  onclick="remover('+al.id+')">Apagar </button> ' +
                "</td>"+
            "</tr>"
            return linha;
            
        }
        function editar(id){
            $.getJSON('/api/alunos/'+id, function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#cpf') .val(data.cpf);
                $('#nomeAluno').val(data.nome)
                $('#semestreAluno').val(data.semestre)
                $('#cpfAluno').val(data.cpf)
                $('#dlgAlunos').modal('show')
            
            });     


        }

        function remover(id){
            $.ajax({
                type:"DELETE",
                url: "/api/alunos/"+id,
                context: this,
                success: function(){
                    console.log('apagou'); 
                    linhas = $("#tabelaAlunos>tbody>tr");
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



        function carregarAlunos(){
            $.getJSON('/api/alunos', function(alunos){
                for (i=0;i<alunos.length;i++){
                    linha = montarlinha(alunos[i])
                    $('#tabelaAlunos>tbody').append(linha)
                    console.log(alunos[i]);
                }
            });
        }
        function criarAluno(){
            aln = {   
                //id:$('#id').val(),
                nome:$("#nomeAluno").val(),
                cpf:$("#cpfAluno").val(),
                semestre:$("#semestreAluno").val(),
                email:$("#emailAluno").val(),
                password:$("#password").val()

            };
            
            console.log(aln);
            $.post("/api/alunos",aln,function(data){
                aluno = JSON.parse(data);
                linha = montarlinha(aluno);
                console.log(data);
                $('#tabelaAlunos>tbody').append(linha); 
            });
        }
            
        function salvarAluno(){                
            aluno = {   
                id : $("#id").val(), 
                cpf: parseInt($("#cpfAluno").val()),
                nome:$("#nomeAluno").val(),
                semestre: parseInt($("#semestreAluno").val())
            };
            console.log(aluno)
            $.ajax({
                type: "PUT",
                url: "/api/alunos/" + aluno.id,
                context: this,
                data: aluno,
                success: function(data) {
                    aln = JSON.parse(data);
                    linhas = $('#tabelaAlunos>tbody>tr');
                    console.log(aln);
                    console.log(linhas);
                    e = linhas.filter( function(i, e) { 
                        return ( e.cells[0].textContent == aln.id );
                    });
                    if(e){
                        e[0].cells[0].textContent = aln.id;
                        e[0].cells[1].textContent = aln.cpf;
                        e[0].cells[2].textContent = aln.nome;
                        e[0].cells[3].textContent = aln.semestre;
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
                    salvarAluno();
                }
                else{
                    //console.log('aqui')
                    
                    criarAluno();                    
                } 
                $("#dlgAlunos").modal('hide');
        });
        
        $(function(){
            carregarProfessores();
            carregarAlunos();
        })
    
    </script>
@endsection