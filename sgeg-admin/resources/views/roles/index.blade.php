@extends('adminlte::page')


@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Roles</h2>
            </div>
            <div class="col-sm-6">
                
            </div>
        </div>
    </div>
</section>
@endsection
@section('content')
    <ul>
        @forelse($roles as $rol)            
            <li> 
                {{ $rol-> id }} {{ $rol-> name }}  
            </li>
        @empty
        <li> List empty</li>
        @endforelse
    </ul>
@endsection