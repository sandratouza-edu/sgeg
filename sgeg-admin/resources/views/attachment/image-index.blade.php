@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Images') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-green" href="{{ route('image.upload') }}">
                            <i class="fas fa-solid fa-image"></i> {{ __('New') }}
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
        $heads = [__('All'), __('Title'), __('Owner'), __('URI'), __('Actions')];

        $config = [
            'order' => [[1, 'asc']],
        ];

    @endphp

    <div>
        @if ($attachments->isEmpty())
            <p>{{ __('List is empty') }}</p>
        @else
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark" striped hoverable with-buttons>
                @forelse($attachments as $attachment)
                    <tr>
                        <td> <input type="checkbox" name="" id=" {{ $attachment->id }}"> </td>
                        <td> {{ $attachment->name }} </td>
                        <td> {{ $attachment->user->name }} </td>
                        <td> <a href="{{$attachment->uri }}" target="_blank"> {{ Str::limit($attachment->name, 122) }} </a> </td>
                        <td>
                            <div class="btn-group">
                                <form action="{{ route('attachment.destroy', $attachment) }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="{{ __('Delete') }}">
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