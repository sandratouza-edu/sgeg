@extends('layouts.app')

@section('content')
<p> </p>
<div>
    <h2>Trajes</h2>
    <table>
        <thead><th>Nombre</th>  <th> Propietario</th><th> Disponible</th><th> </th><th> Acciones</th></thead>
            @forelse($garments as $garment)            
                <tr> 
                    <td>
                        <a href="{{ route('garment.show', $garment->id) }}"> {{ Str::limit($garment->name, 22) }} </a> 
                         </td> 
                  
                  <td> 
                    {{ $garment->waist }}
                </td> 
                <td> 
                      Si{{ $garment->avaliable }}
                      
                </td> 
                <td> 
                <a class="link-button" href="{{ route('garment.edit', $garment->id) }}">Edit </a>
            </td> <td> 
                <form method="POST" action="{{ route('garment.destroy', $garment->id) }}"> 
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
<p><a  class="form-button" href="{{ route('garment.create') }}">CREATE</a></p>
@endsection