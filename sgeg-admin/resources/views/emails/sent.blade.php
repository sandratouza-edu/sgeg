@extends('adminlte::page')


@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@section('content')
    <p> </p>
    <div>
        <a href="{{ route('user') }}">Back</a>
        <h2>Email enviado!</h2>
        
    </div>
@endsection 