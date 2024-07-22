@extends('adminlte::page')

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
                        <a class="btn btn-app bg-secondary" href="{{ route('pdi.index') }}">
                            <i class="fas fa-solid fa-arrow-rotate-left"></i> Back
                        </a>
                        <a class="btn btn-app bg-secondary" href="{{ route('pdi.create') }}">
                            <i class="fas fa-solid fa-person-chalkboard"></i> New
                        </a>
                        <a class="btn btn-app bg-danger" href="{{ route('pdi.index') }}">
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
    if (session()) {
        if (session('message')== 'success') {
            echo '<x-adminlte-alert class="bg-teal text-uppercase" icon="fa fa-lg fa-thumbs-up" title="Done" dismissable>
                complete!
            </x-adminlte-alert>';
        }
    }
@endphp
<div class="card">
    <div class="card-body">
    <p> </p>
    <h2>Añadir </h2>
    <form action="{{ route('pdi.store') }}" method="POST">
        @csrf
    
    <div class="form-group">
        <x-adminlte-input name="usuario" label="usuario" placeholder="Escriba nombre apellidos" label-class="text-lightblue">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-user text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="form-group">
        <label for="description">Surname</label>
        <input type="text" name="surname" />
        <p> </p> @error('surname')
        <p>{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">DNI</label>
        <input type="text" name="dni" />
  
    </div>
    <div class="form-group">
        <label for="description">Email</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
        <input type="text" name="email" />
       
    </div>
    <x-adminlte-select name="state" label="Estado" label-class="text-lightblue"
igroup-size="lg">
<x-slot name="prependSlot">
    <div class="input-group-text bg-gradient-info">
        <i class="fas fa-car-side"></i>
    </div>
</x-slot>
<option>Disponible</option>
<option>No disponible</option>
</x-adminlte-select>
    <div class="form-group">
        <a href="{{ route('pdi.index') }}" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Create" class="btn btn-success float-right">
    </div>
    </form>
</div>
</div>
@endsection