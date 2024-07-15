@extends('layouts.app')

@section('content')
<div>
    @if ($participants->isEmpty())
        <p>List is empty</p>
    @else
    <ul>
        @forelse($participants as $participant)            
            <li> 
                <p> </p>
                Nombre: {{ $participant->name }} {{ $participant->surname }} 
                 <p></p>
                <a href="{{ route('participant.show', $participant->id) }}"> VER </a> 
                | <a href="{{ route('participant.edit', $participant->id) }}">Edit </a>
                 
                <form method="POST" action="{{ route('participant.destroy', $participant->id) }}"> 
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
                <a href="{{ route('participant.create') }}"> CREAR </a> 
            </li>
            
        </li>
    </ul>
    @endif
</div>
@endsection