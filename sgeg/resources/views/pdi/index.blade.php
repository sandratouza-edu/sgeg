@extends('layouts.app')

@section('content')
<div>
    <h2>Añadir</h2>
    <ul>
        @forelse($pdis as $pdi)            
            <li> 
                <p> </p>
                Nombre: {{ $pdi->name }} {{ $pdi->surname }} 
                 <p></p>
                <a href="{{ route('pdi.show', $pdi->id) }}"> VER </a> 
                | <a href="{{ route('pdi.edit', $pdi->id) }}">Edit </a>
                 
                <form method="POST" action="{{ route('pdi.destroy', $pdi->id) }}"> 
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" />
                </form>
                <p> - </p>
            </li>
        @empty
        <li> List empty</li>
        @endforelse
    </ul>
    <ul>
        <li>
            <li> 
                <a href="{{ route('pdi.create') }}"> CREAR </a> 
            </li>
            
        </li>
    </ul>
</div>
@endsection