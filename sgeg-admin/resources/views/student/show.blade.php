@extends('layouts.app')



@section('content')
<div>
<h2>{{ __('Show') }}</h2>

        <h3>{{ __('Name') }}: {{ $user->name }}  </h3>
         <h4> {{ $user->dni }} </h4>
         <h4> {{ $user->email }} </h4>
         <h4> {{ $user->dni }} </h4>
</div>
<p> </p>
<hr>
<p>
<a href="{{ route('user.index') }}">{{ __('Back') }}</a>
</p>
<p> </p>
@endsection