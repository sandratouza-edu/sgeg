@extends('layouts.app')

@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@section('content')

<div>
    <h2>Editar</h2>

    <form action="{{ route('participant.update', $participant->id) }}" method="POST">
        @method('put')
        @csrf
        <label for title>Nombre</label>
        <input type="text" name="name" value="{{ $participant->name }}" />
        <p> </p>
        <label for="description">Apellidos</label>
        <input type="text" name="surname" value="{{ $participant->surname }}"/>
        <p> </p>
        <label for="description">DNI</label>
        <input type="text" name="dni" value="{{ $participant->dni }}"/>
        <p> </p>
        <label for="description">Email</label>
        <input type="text" name="email" value="{{ $participant->email }}"/>        
       
        <p>  
        <input type="submit" value="Update" /> </p>
        <p> </p>
    </form>

</div>
<p> </p>
<hr>
<a href="{{ route('participant.index') }}">Back</a>

@endsection
