@extends('layouts.app')

<h2>Añadir</h2>
@section('content')
    <form action="{{ route('participant.store') }}" method="POST">
        @csrf
        <label for title>Title</label>
        <input type="text" name="name" />
        @error('name')
            <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="description">Surname</label>
        <input type="text" name="surname" />
        @error('surname')
        <p>{{ $message }}</p>
        @enderror
        <label for="description">DNI</label>
        <input type="text" name="dni" />
        @error('dni')
        <p>{{ $message }}</p>
        @enderror
        <label for="description">Email</label>
        <input type="text" name="email" />
        @error('email')
        <p>{{ $message }}</p>
        @enderror
        <label for="image">Image</label>
        <input type="text" name="image" />
        
        <input type="submit" value="create" />
    </form>
@endsection

<a href="{{ route('participant.index') }}">Back</a>
