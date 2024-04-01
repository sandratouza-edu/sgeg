@extends('layouts.app')

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