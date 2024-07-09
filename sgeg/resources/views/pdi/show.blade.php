@extends('layouts.app')



@section('content')
<div>
<h2>Leer</h2>

        <h3>Nombre:{{ $pdi->name }} -{{ $pdi->surname }}   </h3>
         <h4> {{ $pdi->dni }} </h4>
         <h4> {{ $pdi->email }} </h4>
</div>
<p> </p>
<hr>
<p>
<a href="{{ route('pdi.index') }}">VOLVER</a>
</p>
<p> </p>
@endsection