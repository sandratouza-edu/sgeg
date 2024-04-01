@extends('layouts.app')


<h2>Leer</h2>
@section('content')
        <h3>{{ $participant->name }} -{{ $participant->surname }}   </h3>
         <h4> {{ $participant->email }} </h4>
         <h4> {{ $participant->dni }} </h4>
         <h4> {{ $participant->email }} </h4>
         for
         <h5> {{ $participant->image->url }}</h5>
         <h5> {{ $participant->image->url }}</h5>
@endsection

<a href="{{ route('participant.index') }}">Back</a>