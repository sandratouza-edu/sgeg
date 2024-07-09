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
    <form action="{{ route('degree.update', $degree->id) }}" method="POST">
        @method('put')
        @csrf
        <label for title>Nombre</label>
        <input type="text" name="name" value="{{ $degree->name }}" />
        <label for title>Color</label>
        <input type="text" name="color" value="{{ $degree->color }}" />
        <label for title>Descripción</label>
        <input type="text" name="description" value="{{ $degree->description }}" />
        @csrf
        <p> </p>
        <input type="submit" value="Update" />
    </form>
@endsection

<a href="{{ route('degree.index') }}">Back</a>