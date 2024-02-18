@extends('layouts.master')

@section('title', 'número de actores')

@section('content')

<section class="container-fluid content py-5 mt-5">
<h1 class="mb-5">{{$title}}</h1>

@if(empty($actors))
    <FONT COLOR="red">No se ha encontrado ningun actor</FONT>
@else
    <div >
        <p>Total number of films: {{$actors}}</p>
    </div>
    
@endif
</section>
@endsection