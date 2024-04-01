@extends('layouts.app')

@section('content')
    <ul>
        @forelse($garments as $garment)            
            <li> 
                {{ $garment-> name }} {{ $garment-> name }} - DNI: {{ $garment->dni }}
                <a href="{{ route('garment.show', $garment->id) }}"> {{ $garment->title }} </a> 
                | <a href="{{ route('garment.edit', $garment->id) }}">Edit </a>
                |
                <form method="POST" action="{{ route('garment.destroy', $garment->id) }}"> 
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