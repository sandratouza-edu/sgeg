@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Rooms') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-green" href="{{ route('room.create') }}">
                            <i class="fas fa-solid fa-mobile"></i> {{ __('New') }}
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
    @include('layouts.message')
    @php
        $heads = [ __('Name'),
                 ['label' => __('Actions'), 'no-export' => true, 'width' => 10],
        ];

        $config = [
            'order' => [[1, 'asc']],
            'language' => [
                'url' => url('/vendor/datatables-plugins/lang/'.app()->getLocale().'.json'),
            ], 
        ];
    @endphp
    <div class="card">
        <div class="card-body">
        @if ($rooms->isEmpty())
            <p>{{ __('List is empty') }}</p>
        @else
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark" striped hoverable
                with-buttons>
                @forelse($rooms as $room)
                    <tr>
                        <td> {{ $room->name }} </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('room.show', $room->id) }}">
                                    <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                        <i class="fa fa-lg fa-fw fa-eye"></i>
                                    </button>
                                </a>
                                <a class="link-button" href="{{ route('room.edit', $room->id) }}">
                                    <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </button>
                                </a>
                                <form action="{{ route('room.destroy', $room) }}" method="POST" class="form-delete">
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
                        <td>{{ __('List is empty') }} </td>
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

        })
    </script>
@endsection
