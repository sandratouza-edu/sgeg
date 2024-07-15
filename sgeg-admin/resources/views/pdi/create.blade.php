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
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@section('content')

<div>
<p> </p>
<h2>Añadir </h2>
    <form action="{{ route('pdi.store') }}" method="POST">
        @csrf
    
    <div class="form-group">
        <label for title>Nombre</label>
        <input type="text" name="name" />
        <p> </p> @error('name')
            <p>{{ $message }}</p>
        <p> </p> @enderror
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
        <p> </p> @error('dni')
        <p>{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">Email</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
        <input type="text" name="email" />
        @error('email')
        <p>{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <a href="{{ route('pdi.index') }}" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Create" class="btn btn-success float-right">
    </div>
    </form>

</div>
@endsection