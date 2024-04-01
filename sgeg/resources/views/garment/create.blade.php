@extends('layouts.app')

<h2>Añadir</h2>
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@section('content')
    <form action="{{ route('garment.store') }}" method="POST">
        @csrf
        <label for="name">Short Description</label>
        <input type="text" name="name" />         
        <label for="available">Available</label>
        <input type="checkbox" name="available" />
        <label for="description">Height</label>
        <input type="text" name="height" />
        <label for="description">width</label>
        <input type="text" name="width" />
        <label for="description">waist</label>
        <input type="text" name="waist" />
        <label for="description">color</label>
        <input type="text" name="color" />
        <label for="available">width_cap</label>
        <input type="checkbox" name="available" />
        <label for="description">size_cap</label>
        <input type="text" name="size_cap" />

        <input type="submit" value="create" />
    </form>
@endsection

<a href="{{ route('garments.index') }}">Back</a>
