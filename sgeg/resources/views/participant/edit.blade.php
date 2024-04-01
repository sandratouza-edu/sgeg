@extends('layouts.app')

@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<h2>Edit</h2>
@section('content')
    <form action="{{ route('participant.update', $participant->id) }}" method="POST">
        @method('put')
        @csrf
        <label for title>Nombre</label>
        <input type="text" name="name" value="{{ $participant->name }}" />
        <label for="description">Apellidos</label>
        <input type="text" name="surname" value="{{ $participant->surname }}"/>
        <label for="description">DNI</label>
        <input type="text" name="dni" value="{{ $participant->dni }}"/>
        <label for="description">Email</label>
        <input type="text" name="email" value="{{ $participant->email }}"/>        
       
        <h3> {{ $participant->image->url }}</h3>
       
        <input type="submit" value="Update" />
    </form>
@endsection

<a href="{{ route('participant.index') }}">Back</a>