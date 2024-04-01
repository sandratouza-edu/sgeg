@extends('layouts.app')


<h2>Leer</h2>
@section('content')
        <h3>{{ $garment->title }}   </h3>
         <h4> {{ $garment->description }} </h4>
@endsection

<a href="{{ route('garment.index') }}">Back</a>