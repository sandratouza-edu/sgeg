@extends('adminlte::page')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Trajes</h2>
            </div>
            <div class="col-sm-6">
                <div class="btn-group float-sm-right">
                    <a class="btn btn-app bg-secondary" href="{{ route('garment.create') }}">
                        <i class="fas fa-user-tie"></i> New 
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
        $heads = [
            'Name',
            ['label' => 'Owner', 'width' => 40],
            'Available',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];
    @endphp
    <div>
        <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" striped hoverable with-buttons>
            @forelse($garments as $garment)
                <tr>
                    <td>
                        <a href="{{ route('garment.show', $garment->id) }}"> {{ Str::limit($garment->name, 22) }} </a>
                    </td>

                    <td>
                        {{ $garment->waist }}
                    </td>
                    <td>
                         {{ $garment->avaliable }} 
                        @if ($garment->avaliable)  
                        <a class="btn btn-xs bg-green">
                            <i class="fa fa-solid fa-lightbulb"></i>
                        </a>
                        @else
                        <a class="btn btn-xs bg-brown">
                            <i class="fa fa-solid fa-lightbulb"></i>
                        </a>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"  href="{{ route('garment.edit', $garment->id) }}">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('garment.destroy', $garment->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>
                            </form>
                            <a class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details"  href="{{ route('garment.show', $garment->id) }}">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td> List empty</td>
                </tr>
            @endforelse
        </x-adminlte-datatable>
    </div>
@endsection
