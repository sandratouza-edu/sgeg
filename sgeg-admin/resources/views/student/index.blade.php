@extends('adminlte::page')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Student</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary">
                            <i class="fas fa-solid fa-person-chalkboard"></i> New
                        </a>
                      
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            @component('components.csv-form')
            @endcomponent
        </div>
        <div class="card-body">
            @php
                $heads = [
                    'Name',
                    ['label' => 'Phone', 'width' => 40],
                    'Email',
                    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
                ];

                $config = [
                    'language' => [
                        'url' => url('//cdn.datatables.net/plug-ins/2.1.0/i18n/' . app()->getLocale() . '.json'),
                    ], //https://es.stackoverflow.com/questions/87338/cambiar-idioma-de-datatables
                ];

            @endphp


            @if ($users->isEmpty())
                <p>Participants list is empty</p>
            @else
                <x-adminlte-datatable id="tableU" :heads="$heads" :config="$config" head-theme="dark" striped hoverable
                    with-buttons>

                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }} - {{ $user->surname }} </td>
                            <td>
                                <a class="btn btn-xs bg-info">
                                    <i class="fab fa-telegram-plane"></i>
                                </a>
                                {{ $user->phone }}
                            </td>
                            <td> <a href="{{ route('sendmail') }}"> {{ $user->email }} </a></td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('user.show', $user) }}"
                                        class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                        <i class="fa fa-lg fa-fw fa-eye"></i>
                                    </a>
                                    <a href="{{ route('user.edit', $user) }}"
                                        class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </a>
                                    <form action="{{ route('user.destroy', $user) }}" method="POST" class="form-delete">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                            title="Delete">
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
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            })

        })
    </script>
@endsection
