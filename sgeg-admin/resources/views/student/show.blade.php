@extends('layouts.app')



@section('content')
<div>
<h2>Leer</h2>

        <h3>Nombre:{{ $user->name }} -{{ $user->surname }}   </h3>
         <h4> {{ $user->dni }} </h4>
         <h4> {{ $user->email }} </h4>
         <h4> {{ $user->dni }} </h4>
</div>
<p> </p>
<hr>
<p>
<a href="{{ route('user.index') }}">VOLVER</a>
</p>
<p> </p>
@endsection