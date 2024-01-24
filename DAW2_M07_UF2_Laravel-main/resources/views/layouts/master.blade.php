<!DOCTYPE html>
<html lang="es">
    <head>
        @section('header')
        <title>Titulo - @yield('titulo')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/app.css" rel="stylesheet">
    </head>
    <body>
        
        @show 
        <hr>
        <div class="container">
            @yield('content')
            @section('content')
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
        </div>
        <hr>
        @section('footer')
        @show
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
</html>