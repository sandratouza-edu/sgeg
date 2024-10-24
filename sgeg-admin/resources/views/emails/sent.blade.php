@extends('adminlte::page')


@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@section('content')
    <p> </p>
    <div>
        <a href="{{ route('attachment.index') }}"> {{ __('Back') }}</a>
        <h2> {{ __('Email Sent') }}</h2>
        
    </div>
@endsection 