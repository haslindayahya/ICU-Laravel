@extends('layouts.main')

@section('title','Home')
    
@section('content')
@php
    $_name=$name ?? "team";
@endphp

@if ($_name=="rosli")
    <p>You are banned</p>
@else 
    <h1>Hello, {{$_name}} </h1>    
    <button type="button" class="btn btn-primary">Click Me</button>  
@endif
@endsection
