@extends('layouts.app')


<h2>Leer</h2>
@section('content')
        <h3> {{ $degree->name }}   </h3>
        <h4> {{ $degree->description }} </h4>
        <h4> {{ $degree->color }} </h4>
@endsection

<a href="{{ route('degree.index') }}">Back</a>