@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Invitations') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-green" href="{{ route('attachment.create') }}">
                            <i class="fas fa-solid fa-mobile"></i> {{ __('New') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    @php
        $heads = [__('Title'), __('Keywords'), ['label' => __('Actions'), 'no-export' => true, 'width' => 10]];

        $config = [
            'order' => [[1, 'asc']],
            'language' => [
                'url' => url('/vendor/datatables-plugins/lang/'.app()->getLocale().'.json'),
            ], 
        ];
    @endphp
    <div>
        @if ($attachments->isEmpty())
            <p>{{ __('List is empty') }}</p>
        @else
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark" striped hoverable
                with-buttons>
                @forelse($attachments as $attachment)
                    <tr>
                        <td> <strong>  <a href="{{ route('attachment.show', $attachment) }}"> {{ Str::limit($attachment->name, 80) }} </a> </strong></td>
                        <td> {{ $attachment->keywords }}  </td>
                        <td>
                            <div class="btn-group">
                                <a class="link-button" href="{{ route('email', $attachment->id) }}">
                                    <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Enviar">
                                        <i class="fa fa-lg fa-fw fa-envelope"></i>
                                    </button>
                                </a>
                                <a href="{{ route('attachment.show', $attachment->id) }}">
                                    <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                        <i class="fa fa-lg fa-fw fa-eye"></i>
                                    </button>
                                </a>
                                <a class="link-button" href="{{ route('attachment.edit', $attachment->id) }}">
                                    <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </button>
                                </a>
                                <form action="{{ route('attachment.destroy', $attachment) }}" method="POST" class="form-delete">
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
                        <td colspan="3">{{ __('List is empty') }} </td>
                    </tr>
                @endforelse
            </x-adminlte-datatable>
        @endif
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
