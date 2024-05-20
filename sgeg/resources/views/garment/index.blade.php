@extends('layouts.app')

@section('content')
<p> </p>
<div>
    <ul>
        @forelse($garments as $garment)            
            <li> 
                Traje: {{ $garment-> name }} {{ $garment-> name }} - Propietario: {{ $garment->dni }}
                <p> </p>   <a href="{{ route('garment.show', $garment->id) }}"> {{ $garment->title }} </a> 
                <p> </p> <a href="{{ route('garment.edit', $garment->id) }}">Edit </a>
                |
                <form method="POST" action="{{ route('garment.destroy', $garment->id) }}"> 
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" />
                </form>
            </li>
        @empty
        <li> </li>
        <li> List empty</li>
        <li> </li>
        @endforelse
    </ul>
    <p> </p>
</div>

<hr>
<p><a href="{{ route('garment.create') }}">CREATE</a></p>
@endsection