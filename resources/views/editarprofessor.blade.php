@extends('layout.app', ["corrent"=>"professors"]);

@section('body')
<div class="card border">
    <div class="card-body">
        <form action="/professores/{{$prof->id}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="novoProfessor">Nome</label>
                <input type="text" class="form control" name="nomeProfessor"
                    id="nomeProfessor" value="{{$prof->nome}}">
                    <label for="novoemail">EMAIL</label>
                <input type="email" class="form control" name="emailProfessor"
                    id="emailProfessor"  value="{{$prof->email}}">
                    <label for="novonumero">Telefone</label>
                <input type="int" class="form control" name="numeroProfessor"
                    id="numeroProfessor"  value="{{$prof->telefone}}">
            </div>
            <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
            <button type="cancel" class="btn btn-danger btn-sn">Cancelar</button>
            
        </form>
    </div>    
</div>




@endsection
