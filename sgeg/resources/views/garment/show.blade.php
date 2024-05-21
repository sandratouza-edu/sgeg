@extends('layouts.app')


<h2>Leer</h2>
@section('content')
        <h3>{{ $garment->name }}  </h3>
        <label for title>Nombre</label>
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
@endsection

<a href="{{ route('garment.index') }}">Back</a>