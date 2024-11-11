@extends('adminlte::page')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if (isset($filter) && ($filter =='student'))
                        <h2>{{ __('Students') }}</h2>
                    @else
                        <h2>{{ __('Users') }}</h2>
                    @endif
                </div>
                <div class="col-sm-6">
                    @can('user-admin')
                    <div class="btn-group float-sm-right">
                        <form action="{{ route('multi-send') }}" method="POST" class="form-multisend">
                            @csrf
                            <button class="btn btn-app bg-yellow" id="multi-send">
                                <i class="fas fa-envelope"></i> {{ __('Send Email') }}
                            </button>
                            <input type="hidden" value="" name="selected" class="selected">
                        </form>
                        <button class="btn btn-app bg-blue" id="check-all">
                            <i class="fas fa-users"></i> {{ __('Select All') }}
                        </button>
                        <button class="btn btn-app bg-danger" id="multi-delete" data-route="{{ route('user.multi-delete') }}" data-method="POST">
                            <i class="fas fa-inbox"></i> {{ __('Delete selected') }}
                        </button>
                    </div>
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary"  href="{{ route('user.create') }}">
                            <i class="fas fa-user-plus"></i> {{ __('New') }}
                        </a>
                        @can('import')
                        <a class="btn btn-app bg-success"  href="{{ route('userImport') }}">
                            <i class="fas fa-users"></i> {{ __('Import') }}
                        </a>
                        @endcan
                        @can('export')
                        <a class="btn btn-app bg-orange" href="{{ route('export') }}">
                            <i class="fas fa-users"></i> {{ __('Export') }}
                        </a> 
                        @endcan
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </section>
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            @php
                $heads = [
                    __('All'),
                    __('Name'),
                    __('Phone'), 
                    __('Email'), 
                    __('Roles'),
                    __('Degree'),
                    ['label' => __('Actions'), 'export' => true, 'width' => 5],
                ];

                $config = [
                    'pageLength' => 10,
                    'language' => [
                        //'url' => url('//cdn.datatables.net/plug-ins/2.1.0/i18n/'.app()->getLocale().'.json'),
                        'url' => url('/vendor/datatables-plugins/lang/'.app()->getLocale().'.json'),
                    ], //https://es.stackoverflow.com/questions/87338/cambiar-idioma-de-datatables
                ];

            @endphp


            @if ($users->isEmpty())
                <p>{{ __('List is empty') }}</p>
            @else
                <x-adminlte-datatable id="tableU" :heads="$heads" :config="$config" head-theme="dark" striped hoverable
                    with-buttons>
                    @forelse($users as $user)
                        <tr>
                            <td>  
                                <input class="checkbox" type="checkbox" name="c-{{ $user->id }}" value="{{ $user->id }}">
                            </td>
                            <td>{{ $user->name }}   </td>
                            <td>
                                @can('send-msg')
                                    @if(!is_null($user->phone))
                                        @component('components.telegram-button', ['phone' => $user->phone])
                                        @endcomponent
                                    @endif
                                @else 
                                 {{ iconv("UTF-8", "ISO-8859-1//IGNORE", $user->phone) }}
                                @endcan
                            </td>
                            <td> 
                                @can('send-email')
                                <a href="{{ route('sendmail') }}"> 
                                    <i class="fas fa-envelope text-lightblue"></i> 
                                    </a>
                                <a href="{{ route('sendmail') }}"> {{ $user->email }} </a>
                                @else
                                    {{ $user->email }}
                                @endcan
                            </td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-secondary text-dark">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if(!is_null($user->degree_id ) && ($user->degree_id > 0) )
                                    @if(!is_null($user->degree ))
                                        {{ $user->degree->name }}               
                                    @endif
                                @endif
                            </td>
                            <td>
                                @can('user-admin')
                                    <div class="btn-group">
                                        <a href="{{ route('user.show', $user) }}"
                                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="{{ __('Show') }}">
                                            <i class="fa fa-lg fa-fw fa-eye"></i>
                                        </a>
                                        @can('user-edit')
                                        <a href="{{ route('user.edit', $user) }}"
                                            class="btn btn-xs btn-default text-teal mx-1 shadow" title="{{ __('Edit') }}">
                                            <i class="fa fa-lg fa-fw fa-pen"></i>
                                        </a>
                                        @endcan
                                        @can('user-delete')
                                        <form action="{{ route('user.destroy', $user) }}" method="POST" class="form-delete">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                                title="{{ __('Delete') }}">
                                                <i class="fa fa-lg fa-fw fa-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td> {{ __('List is empty') }} </td>
                        </tr>
                    @endforelse
                </x-adminlte-datatable>
            @endif
        </div>
    </div>
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

        $("#check-all").on('click', function() {
           
            $('#tableU .checkbox').prop('checked', true);
         
        })
        $('#multi-delete').on('click', function() {
              var button = $(this);
              var selected = [];
              $('#tableU .checkbox:checked').each(function() {
                selected.push($(this).val());
              });
              
              Swal.fire({
                  icon: 'warning',
                  title: "Multi: {{ __('Are you sure you want to delete?') }}",
                  text: "{{ __('Are selected some record!') }}",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  cancelButtonText: "{{ __('Cancel') }}",
                  confirmButtonText: "{{ __('Delete') }}"
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                  $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: button.data('route'),
                    data: {
                      '_token': $('meta[name="csrf-token"]').attr('content'),
                      'selected': selected
                    },
                    success: function (response, textStatus, xhr) {
                      Swal.fire({
                        icon: 'success',
                          title: response,
                          showDenyButton: false,
                          showCancelButton: false,
                          confirmButtonText: 'Yes'
                      }).then((result) => {
                        window.location='/user'
                      });
                    },
                    error: function (response, textStatus, xhr) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'No se ha podido eliminar',
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: 'Yes'
                        });
                    }
                  });
                }
              });
            });

            $('.form-multisend').submit(function(e) {
                e.preventDefault();
              var button = $(this);
              var selected = [];
              $('#tableU .checkbox:checked').each(function() {
                selected.push($(this).val());
              });
              $('.form-multisend .selected').attr('value', selected);
           
              Swal.fire({
                  icon: 'info',
                  title: "Multi: {{ __('Are you sure you want to send an invitation?') }}",
                  text: "",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  cancelButtonText: "{{ __('Cancel') }}",
                  confirmButtonText: "{{ __('Send') }}"
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                        this.submit();
                    }
                });
                    
            });
    </script>
@endsection
