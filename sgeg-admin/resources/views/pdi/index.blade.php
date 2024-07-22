@extends('adminlte::page')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>PDI</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary">
                            <i class="fa-solid fa-person-chalkboard"></i> New
                        </a>
                        <a class="btn btn-app bg-danger">
                            <i class="fas fa-inbox"></i> Delete
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
            'All',
            'Name',
            'Titulación',
            'Tesis',
            'Telefono',
            'Email',
            ['label' => 'Actions', 'no-export' => true, 'width' => 10],
        ];
    @endphp
    <div>

        <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" striped hoverable with-buttons>
            @forelse($pdis as $pdi)
                <tr>
                    <td>
                        <input type="checkbox" name="{{ $pdi->id }}" id="{{ $pdi->id }}">
                    </td>
                    <td>
                        {{ $pdi->name }} {{ $pdi->surname }}

                    </td>

                    <td>
                        @foreach ($pros as $pro)
                            @if ($pro->user_id == $pdi->id)
                                {{ $pro->degree_color }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $pdi->thesis_date }}
                        @foreach ($pros as $pro)
                            @if ($pro->user_id == $pdi->id)
                                {{ $pro->thesis_date }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-xs bg-info">
                            <i class="fab fa-telegram-plane"></i>
                        </a>
                        {{ $pdi->phone }}
                    </td>
                    <td>
                        <a href="{{ route('sendmail') }}"> {{ $pdi->email }} </a>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('pdi.show', $pdi->id) }}">
                                <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Details">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </button>
                            </a>
                            <a class="link-button" href="{{ route('pdi.edit', $pdi->id) }}">
                                <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                            </a>
                            <form action="{{ route('pdi.destroy', $pdi) }}" method="POST" class="form-delete">
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

    </div>
@endsection

@section('js')
    <script>
        @if (session('message'))
            <
            script >
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
