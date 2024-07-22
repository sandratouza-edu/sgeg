@extends('adminlte::page')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>{{ __('Attach') }}</h2>
            </div>
            <div class="col-sm-6">
                <div class="btn-group float-sm-right">
                    <a class="btn btn-app bg-secondary" href="{{ route('attach.create') }}">
                        <i class="fas fa-solid fa-certificate"></i> {{ __('New') }} 
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
        $heads = ['All', 'Code', 'Title', ['label' => 'Actions']];

        $config = [
            'order' => [[1, 'asc']],
        ];
        
    @endphp

    <div>
    @if ($attachs->isEmpty())
        <p>{{ __('List is empty') }}</p>
    @else
        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark" striped hoverable
            with-buttons>
            @forelse($attachs as $attach)
                <tr>
                    <td> <input type="checkbox" name="" id=""> </td>
                    <td> <a href="{{ $attach->uri }}"  > {{ Str::limit($attach->name, 12) }} </a> </td>
                   
                    <td> {{ $attach->name }} </td>
                    <td>
                        <div class="btn-group">
                            <a class="link-button" href="{{ route('email', $attach->id) }}">
                                <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Enviar">
                                    <i class="fa fa-lg fa-fw fa-envelope"></i>
                                </button>
                            </a>
                            <a href="{{ route('attach.show', $attach->id) }}">
                                <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </button>
                            </a>
                            <a class="link-button" href="{{ route('attach.edit', $attach->id) }}">
                                <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                            </a>
                            <form action="{{ route('attach.destroy', $attach) }}" method="POST" class="form-delete">
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
                    <td> List empty</td>
                </tr>
            @endforelse
        </x-adminlte-datatable>
    @endif
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
