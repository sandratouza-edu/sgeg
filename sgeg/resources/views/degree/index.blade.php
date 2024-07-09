@extends('layouts.app')

@section('content')
<p> </p>
<div>
    <h2>Titulaciones</h2>
    <table>
        <thead><th>Código</th><th> Color </th><th> Titulación </th><th> </th><th>Acciones</th></thead>
            @forelse($degrees as $degree)            
                <tr> <td>
                  {{ $degree->name }}   </td> <td>  {{ $degree->color }} </td> <td>  {{ $degree->description }} </td> <td> 
                 <a href="{{ route('degree.show', $degree->id) }}"> {{ Str::limit($degree->name, 22) }} </a> 
                </td> <td> 
                <a class="link-button" href="{{ route('degree.edit', $degree->id) }}">Edit </a>
            </td> <td> 
                <form method="POST" action="{{ route('degree.destroy', $degree->id) }}"> 
                    @csrf
                    @method('DELETE')
                    <input class="form-button" type="submit" value="Delete" />
                </form>
            </td> </tr> 
            @empty
            <tr> <td> List empty</td></tr>
            @endforelse
        </table>
    </ul>
    <p> </p>
</div>

<hr>
<p><a  class="form-button" href="{{ route('degree.create') }}">CREATE</a></p>
@endsection