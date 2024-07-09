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

    <form action="{{ route('pdi.update', $pdi->id) }}" method="POST">
        @method('put')
        @csrf
        <label for title>Nombre</label>
        <input type="text" name="name" value="{{ $pdi->name }}" />
        <p> </p>
        <p> </p>
        <label for="description">color</label>
        <input type="text" name="dni" value="{{ $pdi->dni }}"/>
        <p> </p>
        <label for="description">Email</label>
        <input type="text" name="email" value="{{ $pdi->email }}"/>        
       
        <p>  
        <input type="submit" value="Update" /> </p>
        <p> </p>
    </form>

</div>
<p> </p>
<hr>
<a href="{{ route('pdi.index') }}">Back</a>

@endsection
