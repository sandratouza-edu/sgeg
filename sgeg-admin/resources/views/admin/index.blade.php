@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>Admin</h1>
@stop

@section('content')
    <p>Welcome Admin SGEG.</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop