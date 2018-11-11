<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Insta Currency</title>
        
        <!-- Bootstrap Bill Turner -->
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/bootstrap-4.0.0/dist/css/bootstrap.min.css')}}" />
        <script type="text/javascript" src="{{asset('/assets/bootstrap-4.0.0/dist/js/bootstrap.min.js')}}"></script>
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">
        
        <!-- APP Css -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}" />
        
        <!-- External helpful things -->
        <link href="https://fonts.googleapis.com/css?family=Courgette|Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    </head>
    <body>
        <header>
            <!-- Aqui o cabeçalho, pode ir um menu -->
        </header>
        <section id="app"></section>
        <footer>
            <!-- Aqui o rodapé, alguma consideração -->
        </footer>
    </body>
        
    <script src="{{asset('js/app.js')}}"></script>
</html>
