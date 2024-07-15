@extends('adminlte::page')


@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Alumnos</h2>
            </div>
            <div class="col-sm-6">
                <div class="btn-group float-sm-right">
                    <a class="btn btn-app bg-secondary">
                        <i class="fas fa-solid fa-person-chalkboard"></i> New
                    </a>
                    <a class="btn btn-app bg-success">
                        <i class="fas fa-users"></i> Import 
                    </a>
                    <a class="btn btn-app bg-orange" href="{{ route('export') }}">
                        <i class="fas fa-users"></i> Export 
                    </a>
                    <a class="btn btn-app bg-danger">                            
                        <i class="fas fa-inbox"></i> Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('content')
<table>
    <tr>
        <td>
            @component('components.search')
            @endcomponent
        </td>
        <td>
            @component('components.csv-form')
            @endcomponent
        </td>
    </tr>
</table>


    @php
        $heads = [
            'Name',
            ['label' => 'Phone', 'width' => 40],
            'Email',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => true]],
        ];

    @endphp


    @if ($users->isEmpty())
        <p>Participants list is empty</p>
    @else
        <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" striped hoverable with-buttons>

            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }} {{ $user->surname }} </td>
                    <td> 
                        <a class="btn btn-xs bg-info">
                            <i class="fab fa-telegram-plane"></i> 
                        </a>
                        {{ $user->phone }} 
                    </td>
                    <td> <a href="{{ route('sendmail') }}"> {{ $user->email }} </a></td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                            <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>
                            <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td> List empty</td>
                </tr>
            @endforelse
        </x-adminlte-datatable>
        
        <div class="pagination">
            @if (!empty($users->links()))
                {{ $users->links() }}
            @endif
        </div>
    @endif

@endsection
