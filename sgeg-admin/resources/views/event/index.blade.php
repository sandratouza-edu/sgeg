@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Events') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('event.create') }}">
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
<div class="card">
    <div class="card-body">
    @php
        $heads = [ __('Name'), __('Date'), __('Room'),
                 ['label' => __('Actions'), 'no-export' => true, 'width' => 10],
        ];

        $config = [
            'order' => [[1, 'asc']],
            'language' => [
                'url' => url('/vendor/datatables-plugins/lang/'.app()->getLocale().'.json'),
            ], 
        ];
    @endphp
    
        @if ($events->isEmpty())
            <p>{{ __('List is empty') }}</p>
        @else
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark" striped hoverable
                with-buttons>
                @forelse($events as $event)
                    <tr>
                        <td> {{ $event->title }} </td>
                        <td> {{ $event->date }} </td>
                        <td> {{ $event->room->name ?? '' }} </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('event.show', $event->id) }}">
                                    <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                        <i class="fa fa-lg fa-fw fa-eye"></i>
                                    </button>
                                </a>
                                <a class="link-button" href="{{ route('event.edit', $event->id) }}">
                                    <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </button>
                                </a>
                                <form action="{{ route('event.destroy', $event) }}" method="POST" class="form-delete">
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
