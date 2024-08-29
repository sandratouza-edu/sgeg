@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2> {{ __('Degrees') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-green" href="{{ route('degree.create') }}">
                            <i class="fas fa-solid fa-certificate"></i> {{ __('New') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    @php
        $heads = [__('Code'), ['label' => __('Color'), 'width' => 40], __('Status'), __('Title'), ['label' => __('Actions')]];

        $config = [
            'order' => [[1, 'asc']],
        ];
        $config = [
            'language' => [
                'url' => url('/vendor/datatables-plugins/lang/'.app()->getLocale().'.json'),
            ],
        ];
    @endphp

    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark" striped hoverable
                with-buttons>
                @forelse($degrees as $degree)
                    <tr>
                        <td> <a href="{{ route('degree.show', $degree->id) }}"> {{ Str::limit($degree->name, 42) }} </a>
                        </td>
                        <td>
                            <span class="text" style="color:  {{ $degree->color }} " href="#">
                                <i class="fas fa-square"></i>
                            </span>
                            {{ $degree->color }}
                        </td>
                        <td> 
                            @if ($degree->active == 1)
                                <span class="text-green">
                                    <i class="fas fa-toggle-on"></i>
                                </span>
                            @else
                                <span class="text-brown">
                                    <i class="fas fa-toggle-off"></i>
                                </span>
                            @endif
                        </td>
                        <td> {{ $degree->description }} </td>
                        <td>
                            @role('admin')
                            <div class="btn-group">
                                <a href="{{ route('degree.show', $degree->id) }}">
                                    <button class="btn btn-xs btn-default text-teal mx-1 shadow" title=" {{ __('Details') }}">
                                        <i class="fa fa-lg fa-fw fa-eye"></i>
                                    </button>
                                </a>
                                <a class="link-button" href="{{ route('degree.edit', $degree->id) }}">
                                    <button class="btn btn-xs btn-default text-primary mx-1 shadow" title=" {{ __('Edit') }}">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </button>
                                </a>

                                <form action="{{ route('degree.destroy', $degree) }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-xs btn-default text-danger mx-1 shadow" title=" {{ __('Delete') }}">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @endrole
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td> {{ __('List Empty') }}</td>
                    </tr>
                @endforelse
            </x-adminlte-datatable>
        </div>
    </div>
@endsection

@section('js')
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
 