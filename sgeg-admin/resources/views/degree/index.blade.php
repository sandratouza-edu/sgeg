@extends('adminlte::page')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Titulaciones</h2>
            </div>
            <div class="col-sm-6">
                <div class="btn-group float-sm-right">
                    <a class="btn btn-app bg-secondary" href="{{ route('degree.create') }}">
                        <i class="fas fa-solid fa-certificate"></i> New 
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
    @php
        $heads = ['All', 'Code', ['label' => 'Color', 'width' => 40], 'Title', ['label' => 'Actions']];

        $config = [
            'order' => [[1, 'asc']],
        ];
        
    @endphp

    <div>
    @if ($degrees->isEmpty())
        <p>List is empty</p>
    @else
        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark" striped hoverable
            with-buttons>
            @forelse($degrees as $degree)
                <tr>
                    <td> <input type="checkbox" name="" id=""> </td>
                    <td> <a href="{{ route('degree.show', $degree->id) }}"> {{ Str::limit($degree->name, 22) }} </a> </td>
                    <td>
                        <a class="text" style="color:  {{ $degree->color }} " href="#"><i class="fas fa-square"></i></a>
                        {{ $degree->color }}
                    </td>
                    <td> {{ $degree->description }} </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('degree.show', $degree->id) }}">
                                <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </button>
                            </a>
                            <a class="link-button" href="{{ route('degree.edit', $degree->id) }}">
                                <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                            </a>

                            <form method="POST" action="{{ route('degree.destroy', $degree->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td> List empty</td>
                </tr>
            @endforelse
        </x-adminlte-datatable>
    @endif
    </div>
@endsection
