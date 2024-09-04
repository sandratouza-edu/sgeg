@extends('layouts.app')

@section('title', 'SGEG')

@section('content')
<h1>Index</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">  {{ env('APP_NAME') }}  </div>

                <div class="card-body">
                   <a href="{{ route('login') }} ">Login</a> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection