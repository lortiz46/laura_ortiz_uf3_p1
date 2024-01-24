<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Include any additional stylesheets or scripts here -->
</head>

<body class="container">
@extends('layouts.master')
@section('title', 'Lista de peliculas')
@section('content')
    <h1 class="mt-4">Lista de Peliculas</h1>
    <ul>
        <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
        <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
        <li><a href=/filmout/films>Pelis</a></li>
        <li><a href=/filmout/filmsByYear>Pelis por año</a></li>
        <li><a href=/filmout/filmsByGenre>Pelis por genero</a></li>
        <li><a href=/filmout/sortFilms>Pelis por año de nueva a antigua</a></li>
        <li><a href=/filmout/countFilms>Numero total de pelis</a></li>
    </ul>
    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->

    <form class="mt-4" action="{{route('createFilm')}}" method="post">
    {{csrf_field()}}
        <h1>Añadir Pelicula</h1>
        <label>Nombre: </label>
        <input type="text" name="name" id="name"/>
        <br>
        <label>Año: </label>
        <input type="number" name="year" id="year"/>
        <br>
        <label>Genero: </label>
        <input type="text" name="genre" id="genre"/>
        <br>
        <label>País: </label>
        <input type="text" name="country" id="country"/>
        <br>
        <label>Duración: </label>
        <input type="number" name="duration" id="duration"/>
        <br>
        <label>Imagen URL</label>
        <input type="text" name="img_url" id="img_url"/>
        <br><br>
        <button type="submit" name="btn">Enviar</button>
        
    </form>

    
    @if(isset($Error))
        <div class="alert alert-danger mt-4">
            <h2 class="text-center">{{ $Error }}</h2>
        </div>
    @endif

    
</body>

</html>
