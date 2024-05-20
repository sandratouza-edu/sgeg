@extends('layouts.app')


@section('content')
<div>
<p> </p>
<h2>Añadir </h2>
    <form action="{{ route('participant.store') }}" method="POST">
        @csrf
        <label for title>Nombre</label>
        <input type="text" name="name" />
        <p> </p> @error('name')
            <p>{{ $message }}</p>
        <p> </p> @enderror
        <br>
        <label for="description">Surname</label>
        <input type="text" name="surname" />
        <p> </p> @error('surname')
        <p>{{ $message }}</p>
        @enderror
        <br>
        <label for="description">DNI</label>
        <input type="text" name="dni" />
        <p> </p> @error('dni')
        <p>{{ $message }}</p>
        @enderror
        <br> <p> </p>
        <label for="description">Email</label>
        <input type="text" name="email" />
        @error('email')
        <p>{{ $message }}</p>
        @enderror
        <br> <p> </p>
        <!--label for="image">Image</label -->
        <p> </p>
        <input type="submit" value="create" />
        <p> </p>
    </form>

<p> 
<a href="{{ route('participant.index') }}">Back</a>
 </p>
</div>
@endsection