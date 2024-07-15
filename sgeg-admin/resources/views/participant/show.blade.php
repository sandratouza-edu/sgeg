@extends('layouts.app')



@section('content')
<div>
<h2>Leer</h2>

        <h3>Nombre:{{ $participant->name }} -{{ $participant->surname }}   </h3>
         <h4> {{ $participant->dni }} </h4>
         <h4> {{ $participant->email }} </h4>
</div>
<p> </p>
<hr>
<p>
<a href="{{ route('participant.index') }}">VOLVER</a>
</p>
<p> </p>
@endsection