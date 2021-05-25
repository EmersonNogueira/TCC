<html>
    <head>
        <link href="{{asset('css/app.css')}}"  rel="stylesheet">
        <title>Sistema TCC</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            body {
                padding: 20px;
                margin-left: 20px;
            }

            .navbar {
                margin-bottom: 15px; 
                margin-left: 1px;
            }
        </style>
    </head>
<body>
    <div class="container">
        @component('componentsprof',["corrent"=> $corrent])
        @endcomponent            
        <main role="main">
            @hasSection ('body')

                @yield('body')    
                
            @endif
    </div>


    <script src="{{ asset('js/app.js')}}" type="text/javascript"></script>

    @hasSection ('javascript')

        @yield('javascript')    
    
    @endif
</body>
</html>

