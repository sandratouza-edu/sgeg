@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>permissions</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <x-adminlte-button label="Nuevo" class="btn btn-app bg-secondary" icon="fas fa-solid fa-user-lock"  data-toggle="modal" data-target="#modalPurple" />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            @php
                $heads = [['label' => 'Id', 'width' => 10], 'Name', ['label' => 'Actions', 'no-export' => true, 'width' => 30]];

                $config = [
                    'language' => [
                        'url' => url('//cdn.datatables.net/plug-ins/2.1.0/i18n/'.app()->getLocale().'.json'),
                    ], 
                ];

            @endphp
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark">
                @forelse ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }} </td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('permission.edit', $permission) }}"
                                    class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                                <form action="{{ route('permission.destroy', $permission) }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                        title="Delete">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <td> List empty</td>
                    </tr>
                @endforelse
            </x-adminlte-datatable>
        </div>
    </div>


<x-adminlte-modal id="modalPurple" title="Nuevo Permiso" theme="secondary"
    icon="fas fa-bolt" size='lg' disable-animations>
    <form action="{{ route('permission.store') }}" method="POST">
        @csrf
        <x-adminlte-input name="name" label="permission" placeholder="Escriba  el permiso" label-class="text-grey">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-solid fa-user-lock"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
        <x-adminlte-button type="Submit" label="Guardar" theme="secondary" icon="fas fa-key" />
    </form> 
</x-adminlte-modal>
@endsection
