@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2> {{ __('Titulaciones') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('degree.create') }}">
                            <i class="fas fa-solid fa-certificate"></i> {{ __('new') }}
                            <a class="btn btn-app bg-danger">
                                <i class="fas fa-inbox"></i> {{ __('delete') }}
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
        $config = [
            'language' => [
                'url' => url('//cdn.datatables.net/plug-ins/2.1.0/i18n/' . app()->getLocale() . '.json'),
            ],
        ];
    @endphp

    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark" striped hoverable
                with-buttons>
                @forelse($degrees as $degree)
                    <tr>
                        <td>
                            <input type="checkbox" name="{{ $degree->id }}" id="{{ $degree->id }}">
                        </td>
                        <td> <a href="{{ route('degree.show', $degree->id) }}"> {{ Str::limit($degree->name, 22) }} </a>
                        </td>
                        <td>
                            <a class="text" style="color:  {{ $degree->color }} " href="#"><i
                                    class="fas fa-square"></i></a>
                            {{ $degree->color }}
                        </td>
                        <td> {{ $degree->description }} </td>
                        <td>
                            @role('admin')
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

                                <form action="{{ route('degree.destroy', $degree) }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @endrole
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td> List empty</td>
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
                    title: "Action",
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
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
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
