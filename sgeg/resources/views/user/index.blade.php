@extends('layouts.landing')

@section('tools') 
 
<table>
    <tr><td>
    @component('components.search')
        
    @endcomponent
    </td><td>
    @component('components.csv-form')
        
    @endcomponent
    </td></tr>
</table>

@endsection

@section('content') 
    <h2>Alumnos</h2>
    @if($users->isEmpty())
        <p>Participants list is empty</p>
    @else
    <table>
        <thead><th>Nombre</th><th>Tfno</th><th>email</th></thead>
        @forelse($users as $user)            
            <tr> <td>{{ $user-> name }} {{ $user->surname }}  </td> 
                <td> {{ $user->phone }}  </td> <td> <a href="{{ route('sendmail') }}"> {{ $user->email }} </a></td></tr>
        @empty
        <tr> <td> List empty</td></tr>
        @endforelse
    </table>
    <hr>
    <div class="pagination">
        {{ $users->links() }}
    </div>
    <hr>
    
    @endif

@endsection
