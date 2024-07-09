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
    <h2>Añadir Grado</h2>

    <form action="{{ route('degree.store') }}" method="POST">
        @csrf
        <label for title>Nombre</label>
        <input type="text" name="name" value="{{ old('name') }}" />
        <label for title>Color</label>
        <input type="text" name="color" value="{{ old('color') }}" />
        <label for title>Descripción</label>
        <input type="text" name="description" value="{{ old('description') }}" />
        <p> </p> 
        <input type="submit" value="create" />
        <p> </p>
    </form>

    <p> </p>
    <p> <a href="{{ route('degree.index') }}">Back</a> </p>
</div>
@endsection