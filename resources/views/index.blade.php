@extends('layout.appindex',["corrent"=>"professors"]);
@section('body')
    
    <div class="jumbotron bg-light border-secundary">
        <div class="row">
            <div class="card-deck">
                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Login</h5>
                        <p class="card-text">
                        </p>
                        <a class="nav-link" href="/aluno/login">Login Aluno </a>
                    </div>
                    
                </div>
                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Login</h5>
                        <p class="card-text">
                        </p>
                        <a class="nav-link" href="/prof/login">Login Professor </a>
                    </div>
                    
                </div>
                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Login</h5>
                        <p class="card-text">
                        </p>
                        <a class="nav-link" href="/login">Login Administrador </a>
                    </div>
                </div>
            </div>
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
                        <input type="hidden" id="cpf" class="form-control">
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
        function novoAluno(){
            $('#nomeAluno').val('')
            $('#semestreAluno').val('')
            $('#cpfAluno').val('')
            $('#dlgAlunos').modal('show')
   
        }

        function criarAluno(){
                aln = {   
                    nome:$("#nomeAluno").val(),
                    cpf:$("#cpfAluno").val(),
                    semestre:$("#semestreAluno").val()

                };
                $.post("/api/alunos",aln,function(data){
                    aluno = JSON.parse(data);
                });
            }
        

        $("#formAluno").submit(function(event){
                event.preventDefault();
                if ($("#id").val() != ''){ 
                    criarAluno();
                }
                else{
                    salvarAluno();
                } 
                $("#dlgAlunos").modal('hide');
            });
    </script>
@endsection
