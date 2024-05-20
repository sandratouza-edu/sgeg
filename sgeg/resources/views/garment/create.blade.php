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
    <h2>Añadir</h2>

    <form action="{{ route('garment.store') }}" method="POST">
        @csrf
        <label for="name">Propietario</label>
        <input type="text" name="own" />     
        <label for="name">Short Description</label>
        <input type="text" name="name" />     
            
        <label for="available">Available</label>
        <input type="checkbox" name="available" /><p> </p>
        <label for="description">Height</label>
        <input type="text" name="height" /><p> </p>
        <label for="description">width</label>
        <input type="text" name="width" /><p> </p>
        <label for="description">waist</label>
        <input type="text" name="waist" /><p> </p>
        <label for="description">color</label>  
        <input type="text" name="color" /><p> </p>
        <label for="available">width_cap</label>
        <input type="checkbox" name="available" /><p> </p>
        <label for="description">size_cap</label>
        <input type="text" name="size_cap" /><p> </p>
        <p> </p>
        <input type="submit" value="create" />
        <p> </p>
    </form>

    <p> </p>
    <p> <a href="{{ route('garment.index') }}">Back</a> </p>
</div>
@endsection