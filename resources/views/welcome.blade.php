<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Insta Currency</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css" />
        
        <!-- Bootstrap Bill -->
        <link rel="stylesheet" type="text/css" href="/assets/bootstrap-4.0.0/dist/css/bootstrap.min.css" />
        <script type="text/javascript" src="/assets/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
        
        <!-- Css do app -->
        <link rel="stylesheet" type="text/css" href="/css/app.css" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
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
        
    <script src="/js/app.js"></script>
</html>
