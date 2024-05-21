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
    <form action="{{ route('garment.update', $garment->id) }}" method="POST">
        @method('put')
        @csrf
        <label for title>Nombre</label>
        <input type="text" name="title" value="{{ $garment->name }}" />
        @csrf
        <label for="name">Short Description</label>
        <input type="text" name="name" value="{{ $garment->name }}" />         
        <label for="available">Available</label>
        <input type="checkbox" name="available" @if($garment->avaliable) checked @endif />
        <label for="description">Height</label>
        <input type="text" name="height" value="{{ $garment->height }}" />
        <label for="description">width</label>
        <input type="text" name="width" value="{{ $garment->width }}" />
        <label for="description">waist</label>
        <input type="text" name="waist" value="{{ $garment->waist }}" />
        <label for="description">color</label>
        <input type="text" name="color" value="{{ $garment->color }}" />
        <label for="available">width_cap</label>
        <input type="checkbox" name="available" @if($garment->width_cap) checked @endif />
        <label for="description">size_cap</label>
        <input type="text" name="size_cap" value="{{ $garment->size_cap }}"/>

<p></p>

        <input type="submit" value="Update" />
    </form>
@endsection

<a href="{{ route('garment.index') }}">Back</a>