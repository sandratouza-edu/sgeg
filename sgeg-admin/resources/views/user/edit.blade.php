@extends('adminlte::page')

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Titulaciones</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('user.index') }}">
                            <i class="fas fa-solid fa-arrow-rotate-left"></i> Back
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
        <h2>{{ __('Edit') }}</h2>
        {!! Form::model($user, ['route' => ['user.update', $user], 'method' => 'put']) !!}
        @method('put')
        @csrf
    <div class="form-group">
        <x-adminlte-input name="name" label="Nombre y Apellidos" value="{{ $user->name }}" 
                        label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
    </div>
    <div class="form-group">
        <x-adminlte-input name="dni" label="DNI" value="{{ $user->dni }}"
        label-class="text-lightblue">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-idcard text-lightblue"></i>
            </div>
        </x-slot>
    </x-adminlte-input>
    </div>
    <div class="form-group">
        <x-adminlte-input name="email" label="Email"  value="{{ $user->email }}" 
        label-class="text-lightblue">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-envelope text-lightblue"></i>
            </div>
        </x-slot>
    </x-adminlte-input>
    </div>
    <div class="form-group">
        <x-adminlte-input name="phone" label="Telefono" value="{{ $user->phone }}"
        label-class="text-lightblue">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-phone text-lightblue"></i>
            </div>
        </x-slot>
    </x-adminlte-input>
    </div>
    <div class="form-group">
        @role('admin')
        <div class="card">
            <div class="card-body">
                @foreach ($roles as $role)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, $user->hasAnyRole($role->id) ?: false, ['class' => 'mr-1']) !!}
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach

            </div>
        </div>
        @endrole
    </div>
    <div class="form-group">
        {!! Form::submit('Actualizar', ['class' => 'btn btn-secondary mt-3']) !!}
        {!! Form::close() !!}
    </div>
        </div>
    </div>
    <p> </p>
 
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
@endsection
