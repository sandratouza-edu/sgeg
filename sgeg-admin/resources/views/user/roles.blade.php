@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Roles') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <x-adminlte-button label="Nuevo" class="btn btn-app bg-green" icon="fas fa-solid fa-ruler"  data-toggle="modal" data-target="#modalPurple" />
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
                $heads = [['label' => 'Id', 'width' => 10], __('Name'), ['label' => __('Actions'), 'no-export' => true, 'width' => 10]];

                $config = [
                    'language' => [
                        'url' => url('/vendor/datatables-plugins/lang/'.app()->getLocale().'.json'),
                    ],
                ];

            @endphp
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark">
                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->id }} </td>
                        <td>{{ $role->name }} </td>
                        <td>
                            <div class="btn-group">                               
                                @can('role-edit')
                                <a href="{{ route('role.edit', $role) }}"
                                    class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                                @endcan
                                {{-- Cambiar a la lógica no permitir borrar los roles principales--}}
                                @if ($role->id >3)
                                @can('role-delete')
                                <form action="{{ route('role.destroy', $role) }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                        title="Delete">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                    </button>
                                </form>
                                @endcan
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <td colspan="3"> {{ __('List is empty') }}</td>
                    </tr>
                @endforelse
            </x-adminlte-datatable>
        </div>
    </div>


<x-adminlte-modal id="modalPurple" title="{{ __('New') }} {{ __('Rol') }}" theme="secondary"
    icon="fas fa-bolt" size='lg' disable-animations>
    <form action="{{ route('role.store') }}" method="POST">
        @csrf
        <x-adminlte-input name="name" label="{{ __('Rol') }}" placeholder="Escriba  el rol" label-class="text-grey">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-user text-grey"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
        <x-adminlte-button type="Submit" label="{{ __('Save') }}"  class="bg-green" theme="secondary" icon="fas fa-key" />
        <x-adminlte-button theme="danger" label="{{ __('Cancel') }}" data-dismiss="modal"/>
    </form> 
    <x-slot name="footerSlot">
    </x-slot>
</x-adminlte-modal>
@endsection


@section('js')
<script src="/vendor/sweetalert/sweetalert2@11.js"></script>
    @if (session('message'))
        <script>
            $(document).ready(function() {
                let message = "{{ session('message') }}";
                Swal.fire({
                    title: "{{ __('Action') }}",
                    text: message,
                    icon: "success",
                })
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.form-delete').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: "{{ __('Are you sure you want to delete?') }}",
                    text: "",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "{{ __('Cancel') }}",
                    confirmButtonText: "{{ __('Delete') }}"
                }).then((result) => {
                    //if (result.isConfirmed) {
                    if (result.value) {
                        this.submit();
                    }
                });
            })

        });
    </script>
@endsection