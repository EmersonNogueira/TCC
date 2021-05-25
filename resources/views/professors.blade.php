@extends('layouts.app')
@extends('layout.app',["corrent" => "professors"])
@section('body')
<div class="card-body">
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Categorias</h5>
        <table class="table table-ordered table-hover" id="tabelaProfessor">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Professor</th>
                    <th>EMAIL do Professor</th>
                    <th>Telefone do Professor</th>
                    <th>Acoes</th>
                </tr>
                <tbody>
                    @foreach ($profs as $prof )
                        <tr>
                            <td>{{$prof->cpf}}</td>
                            <td>{{$prof->nome}}</td>
                            <td>{{$prof->email}}</td>
                            <td>{{$prof->telefone}}</td>
                            <td>
                            <a href="/professores/editar/{{$prof->cpf}}" class="btn btn-sm btn-primary">Editar</a>
                                <button class="btn btn-sm btn-danger" onclick="remover('{{$prof->cpf}}')">Apagar</a>
                            </td>
                        </tr>
                        
                    @endforeach

                </tbody>
            </thead>

        </table>
    
    </div>
    <div class="card-footer">
        <a href="/professores/novo" class="btn btn-sm btn-primary" role="button">Cadastrar professor</a>
        
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

        function logout(){
            $.post("/logout")
        }

        function remover(id){
            $.ajax({
                type: "DELETE",
                url: "/professores/apagar/" + id,
                context: this,
                success:function(){
                    console.log('Apagou ok');
                    linhas = $("#tabelaProfessor>tbody>tr");
                    e = linhas.filter(function(i, elemento){
                        return elemento.cells[0].textContent == id;
                    
                    });
                    if(e){
                        e.remove();
                    }    
                },
                error: function(error){
                    console.log(error);

                }
            });
    
        }  
    </script>    
@endsection