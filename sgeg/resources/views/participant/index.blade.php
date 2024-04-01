@extends('layouts.app')

@section('content')
    <ul>
        @forelse($participants as $participant)            
            <li> 
                {{ $participant->name }} {{ $participant->surname }}  
                <a href="{{ route('participant.show', $participant->id) }}"> show </a> 
                | <a href="{{ route('participant.edit', $participant->id) }}">Edit </a>
                |
                <form method="POST" action="{{ route('participant.destroy', $participant->id) }}"> 
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" />
                </form>
            </li>
        @empty
        <li> List empty</li>
        @endforelse
    </ul>
@endsection