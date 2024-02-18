@extends('layouts.master')
@section('content')

@include('sections.header')
<section class="container-fluid content py-5 mt-5">
<h1>{{$title}}</h1>

@if(empty($actors))
    <FONT COLOR="red">No se ha encontrado ningun actor</FONT>
@else
    <div align="center">
       
        <table border="1">
        @foreach($actors as $actor)
            <tr>
                <td>{{$actor->id}}</td>
                <td>{{$actor->name}}</td>
                <td>{{$actor->surname}}</td>
                <td>{{$actor->birthday}}</td>
                <td>{{$actor->country}}</td>
                <td><img src="{{ $actor->img_url }}" style="width: 100px; height: 120px;"/></td>
            </tr>
        @endforeach
        </table>
        @include('sections.footer')
    </div>
    @endif
</section>
@endsection
<style>
    body{
        text-align: center;
        background-color: plum;
    }
</style>
