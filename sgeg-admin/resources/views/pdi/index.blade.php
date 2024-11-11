@extends('adminlte::page')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('PDI') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-green" href="{{ route('pdi.create') }}">
                            <i class="fas fa-user"></i> {{ __('New') }}
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
            __('Name'),
            __('Degree'),
            __('Thesis'),
            __('Phone'),
            __('Email'),
            __('Is Sponsor'),
            ['label' => __('Actions'), 'no-export' => true, 'width' => 10],
        ];

        $config = [
            'language' => [ 
                'url' => url('/vendor/datatables-plugins/lang/'.app()->getLocale().'.json'),
            ], 
        ];
    @endphp
    <div>
        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark" striped hoverable with-buttons>
            @forelse($pdis as $pdi)
                <tr>
                    <td>  
                        @if(!is_null($pdi->user))
                        {{ $pdi->user->name }} 
                        @endif
                    </td>
                    <td>  
                        @if (isset($pdi->user->degree) &&  !is_null($pdi->user->degree) )
                            {{ $degrees->find($pdi->user->degree)->name }} 
                        @endif
                    </td>                    
                    <td>
                        {{ $pdi->thesis_date }}
                    </td>
                    <td>  
                        @if(!is_null($pdi->user))
                            @component('components.telegram-button', ['phone' => $pdi->user->phone])
                            @endcomponent
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-xs bg-info" data-toggle="modal" data-target="#modalEmail">
                            <i class="fas fa-envelope"></i> 
                        </a>   
                        @if (!is_null($pdi->user))
                        {{ $pdi->user->email }} 
                        @endif
                     
                    </td>
                    <td>
                        <div class="btn-group"> 
                            @if (!is_null($pdi->is_godfather) && ($pdi->is_godfather > 0 ))
                                <a href="#" class="link-button bg-green" label="{{ __('Unassign') }}" data-toggle="modal" data-target="#modalAssign" 
                                    data-assigned="{{  $pdi->is_godfather }}" data-route="{{ route('pdi.assign-godfather', $pdi)  }}"  data-pdi="{{ $pdi->id }}">
                                     <i class="fas fa-user-alt-slash"></i>
                                </a>
                                   <small>&nbsp;{{ $degrees->find($pdi->is_godfather)->name }}  </small>
                            @else
                                <a href="#" class="link-button bg-brown" label="{{ __('Assign') }}" data-toggle="modal" data-target="#modalAssign" 
                                data-route="{{ route('pdi.assign-godfather', $pdi)  }}" data-pdi="{{ $pdi->id }}">
                                      <i class="fas fa-user-graduate"></i>
                                </a> 
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('pdi.show', $pdi) }}">
                                <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="{{ __('Details') }}">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </button>
                            </a>
                            <a class="link-button" href="{{ route('pdi.edit', $pdi) }}">
                                <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="{{ __('Edit') }}">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                            </a>
                            <form action="{{ route('pdi.destroy', $pdi) }}" method="POST" class="form-delete">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                    title="{{ __('Delete') }}">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td> {{ __('List is empty') }}</td>
                </tr>
            @endforelse
        </x-adminlte-datatable>
    </div>
    
    <x-adminlte-modal id="modalEmail" title="{{ __('Email') }}" theme="secondary" icon="fas fa-envelope" size='lg' disable-animations>
        <form action="{{ route('sendmail') }}" method="POST">
            @csrf
            <x-adminlte-input name="title" label="email" placeholder="{{ __('Title') }}" label-class="text-grey">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-grey"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-input name="text" label="email" placeholder="{{ __('Text') }}" label-class="text-grey">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-grey"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-button type="Submit" label="{{ __('Send') }}" theme="secondary" icon="fas fa-envelope" />
        </form> 
    </x-adminlte-modal>


    <x-adminlte-modal id="modalAssign" title="{{ __('Degrees') }}" theme="secondary" icon="fab fa-edit" size='lg' disable-animations>
        <h4> {{ __('Godfather') }}  </h4>
        @php
            $options = [];
            foreach ($degrees as $degree) {
                if ($degree->active == 1) {
                    $options[$degree->id] = $degree->name; 
                }
            }
        @endphp
        <form action="" id="assign" method="POST">
            @csrf
            <x-adminlte-select id="is_godfather" name="is_godfather" label="{{ __('Godfather') }}" label-class="text-lightblue">
                <x-slot name="prependSlot"> 
                    <div class="input-group-text">
                        <i class="fas fa-lg fa-graduation-cap text-lightblue"></i>
                    </div>
                </x-slot>                
                <x-adminlte-options :options="$options" empty-option="{{ __('Select an option...') }}" />
            </x-adminlte-select>
            <x-adminlte-input type="hidden" name="pdi" class="pdi" value=""> </x-adminlte-input>
            <x-adminlte-button type="Submit" label="{{ __('Save') }}" class="bg-green" theme="secondary" icon="fas fa-key" />
        </form> 
    </x-adminlte-modal>

@endsection


@section('js')
    <script>
        $('#modalAssign').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var pdi = button.data('pdi');
            var modal = $(this);
            assigned = button.data('assigned');
            modal.find('#is_godfather').val(assigned);
            modal.find('.pdi').val(pdi);
            let  url = button.data('route');

           modal.find('#assign').attr('action', url);
           event.preventDefault;
        });
    </script>
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

        })
    </script>
@endsection
