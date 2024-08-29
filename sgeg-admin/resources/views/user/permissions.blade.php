@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Permissions') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <x-adminlte-button label="{{ __('New')}}" class="btn btn-app bg-green" icon="fas fa-solid fa-user-lock"  data-toggle="modal" data-target="#modalPurple" />
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
                $heads = [['label' => __('Id'), 'width' => 10], __('Name'), ['label' => __('Actions'), 'no-export' => true, 'width' => 10]];

                $config = [
                    'language' => [
                        'url' => url('/vendor/datatables-plugins/lang/'.app()->getLocale().'.json'),
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
                                <a href="#"  data-toggle="modal" data-target="#modalDetail" data-name="{{ $permission->name }}" data-roles="{{ $permission->roles }}"
                                    class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <td> {{ __('List is empty') }}</td>
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


    <x-adminlte-modal id="modalDetail" title="{{ __('Permission') }}" theme="secondary"
        icon="fas fa-eye" size='lg' disable-animations>
    <div>  
        <div class="modal-header">
            <h4 id="permission"></h4>
        </div>
        <div class="modal-body">
            <h3> {{ __('Rols') }}</h3>
            <div id="roles">
            </div>    
        </div>
    </x-adminlte-modal>
@endsection

@section('js')
    <script>
        $('#modalDetail').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var permission = button.data('name');
            var modal = $(this);
            modal.find('#permission').text( permission);
            var roles =  button.data('roles');
            for (let clave in roles){
                let p = document.createElement("div");
                p.innerHTML = '<h4> <span class="badge badge-primary text-dark">'+roles[clave]['name']+ "</span></h4>";
                modal.find('.modal-body #roles').append(p);
            
            }
           
        })
    </script>
  @endsection