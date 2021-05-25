@extends('layout.app', ["corrent"=>"professors"]);

@section('body')
<div class="card border">
    <div class="card-body">
        <form action="/professores" method="POST">
            @csrf
            <div class="form-group">
                <label for="novoProfessor">Nome</label>
                <input type="text" class="form control" name="nomeProfessor"
                id="nomeProfessor">
                <label for="cpfProfessor">CPF</label>
                <input type="number" class="form control" name="cpfProfessor"
                id="cpfProfessor">
                <label for="novoemail">EMAIL</label>
                <input type="email" class="form control" name="emailProfessor"
                id="emailProfessor">
                <label for="novonumero">Telefone</label>
                <input type="int" class="form control" name="numeroProfessor"
                id="numeroProfessor">
                <label for="password">Senha</label>
                <input type="int" class="form control" name="password" id="password">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
            <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
            <button type="cancel" class="btn btn-danger btn-sn">Cancelar</button>
            
        </form>
    </div>    
</div>

</div>


@endsection
