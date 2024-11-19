@extends('adminlte::page')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Academic Garments') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right"> 
                        <a class="btn btn-app bg-secondary bg-info" href="{{ route('garment.borrow') }}">
                            <i class="fas fa-solid fa-graduation-cap"></i> {{ __('Request') }} 
                        </a>
                        <a class="btn btn-app bg-green" href="{{ route('garment.create') }}">
                            <i class="fas fa-user-tie"></i> {{ __('New') }} 
                        </a>
                        <a class="btn btn-app bg-danger">
                            <i class="fas fa-inbox"></i> {{ __('Delete') }}
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
            __('Color'),
            __('With Cap'),
            __('Owner'),
            __('Available'),
            __('Requests'),
            ['label' => __('Actions'), 'no-export' => true, 'width' => 5],
        ];
        $config = [
            'language' => [
                'url' => url('/vendor/datatables-plugins/lang/'.app()->getLocale().'.json'),
            ], 
        ];
    @endphp
    <div class="card">
        <div class="card-body">
        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark" striped hoverable with-buttons>
            @forelse($garments as $garment)
                <tr>
                    <td>
                        <a href="{{ route('garment.show', $garment->id) }}"> {{ $garment->name }} </a>
                    </td>
                    <td>
                        <span style="color:  {{ $garment->color }}">
                            <i class="fas fa-square"></i> 
                        </span>  {{ $garment->color }}   
                    </td>
                    <td>
                        @if ($garment->with_cap == 1)
                            <span class="text-green">
                                <i class="fa fa-solid fa-graduation-cap"></i>
                            </span>
                        @else
                            <span class="text-brown">
                                <i class="fa fa-solid fa-times"></i>
                            </span>
                        @endif
                    </td>
                    <td>
                        @if (!is_null($garment->user)) {{ $garment->user->name}} @endif
                    </td>
                    <td>  
                        @if ($garment->available == 1)
                            <span class="text-green">
                                <i class="fas fa-toggle-on"></i>
                            </span>
                        @else
                            <span class="text-brown">
                                <i class="fas fa-toggle-off"></i>
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="text-orange">  
                            @if (count($garment->users)> 0) 
                            <i class="fa fa-solid fa-lightbulb"></i> ( {{count($garment->users) }}) 
                            @endif
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-xs btn-default text-primary mx-1 shadow" title="{{ __('Edit') }}"
                                href="{{ route('garment.edit', $garment->id) }}">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                              
                            <a class="btn btn-xs btn-default text-teal mx-1 shadow" title="{{ __('Details') }}"
                                href="{{ route('garment.show', $garment->id) }}">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </a>
                            <form action="{{ route('garment.destroy', $garment) }}" method="POST" class="form-delete">
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
                    <td>{{ __('List is empty') }}</td>
                </tr>
            @endforelse
        </x-adminlte-datatable>
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

        })
    </script>
@endsection
