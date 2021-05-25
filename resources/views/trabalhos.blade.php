
<!doctype html>
<html lang="pt-br">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Trabalhos IFCE</title>
    <style>
        body { padding: 20px; }
        .navbar { margin-bottom: 20px; }
        :root { --jumbotron-padding-y: 10px; }
        .jumbotron {
          padding-top: var(--jumbotron-padding-y);
          padding-bottom: var(--jumbotron-padding-y);
          margin-bottom: 0;
          background-color: #fff;
        }
        @media (min-width: 768px) {
          .jumbotron {
            padding-top: calc(var(--jumbotron-padding-y) * 2);
            padding-bottom: calc(var(--jumbotron-padding-y) * 2);
          }
        }
        .jumbotron p:last-child { margin-bottom: 0; }
        .jumbotron-heading { font-weight: 300; }
        .jumbotron .container { max-width: 40rem; }
        .btn-card { margin: 4px; }
        .btn { margin-right: 5px; }
        footer { padding-top: 3rem; padding-bottom: 3rem; }
        footer p { margin-bottom: .25rem; }
    </style>
</head>
<body>

    <header>
   
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <a href="#" class="navbar-brand d-flex align-items-center">
          <a class="nav-link" href="/professor/alunos">Aluno </a>
          <a class="nav-link" href="/professor/temas">Temas </a>

        </a>
    </div>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <a href="#" class="navbar-brand d-flex align-items-center">
          <strong>Trabalhos  Acadêmico Desolvolvido no IFCE</strong>

        </a>
    </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Envie aqui um trabalho</h1>
          <form method="POST" action="/trabalho" enctype="multipart/form-data">
            @csrf
            <div class="form-group text-left">
              <label for="nome">Nome do Autor</label>
              <textarea class="form-control" id="nome" name="nome" rows="1"></textarea>
            </div>
            <div class="form-group text-left">
              <label for="email">Endereço de e-mail do Autor</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="nome@dominio.com">
            </div>
            <div class="form-group text-left">
              <label for="nome">Titulo do trabalho</label>
              <textarea class="form-control" id="titulo" name="titulo" rows="1"></textarea>
            </div>
            <div class="form-group text-left">
              <label for="nome">Resumo</label>
              <textarea class="form-control" id="resumo" name="resumo" rows="4"></textarea>
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="arquivo" name="arquivo">
              <label class="custom-file-label" for="arquivo">Escolha um arquivo</label>
            </div>
            <p>
              <button type="submit" class="btn btn-primary my-2">Enviar</button>
              <button type="reset" class="btn btn-secondary my-2">Cancelar</button>
            </p>
          </form>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">

            @foreach ($trabalhos as $trabalho )
                
                <div class="col-md-4">
                  <div class="card mb-4 shadow-sm">
                    <!--<img class="card-img-top figure-img img-fluid rounded" src="/storage/{{$trabalho->arquivo}}">-->
                    <div class="card-body">
                      <p class="card-text">{{$trabalho->Nome}}</p>
                      <p class="card-text">{{$trabalho->email}}</p>
                      <p class="card-text">{{$trabalho->titulo}}</p>
                      <p class="card-text">{{$trabalho->resumo}}</p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <!--button type="button" class="btn btn-sm btn-outline-secondary">Download</button-->
                          <a type="button" class="btn btn-sm btn-outline-secondary" href="/trabalho/download/{{$trabalho->id}}">Download</a>
                          <form method="post" action="/trabalho/{{$trabalho->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Apagar</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
          </div>
        </div>
      </div>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Voltar para cima</a>
        </p>
        <p>©2018 Sua empresa.com</p>
      </div>
    </footer>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
