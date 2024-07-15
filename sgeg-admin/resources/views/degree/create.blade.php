@extends('adminlte::page')



@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Alumnos</h2>
            </div>
            <div class="col-sm-6">
                <div class="btn-group float-sm-right">
                    <a class="btn btn-app bg-secondary">
                        <i class="fas fa-user"></i> New
                    </a>
                    <a class="btn btn-app bg-success">
                        <i class="fas fa-users"></i> Import 
                    </a>
                    <a class="btn btn-app bg-orange" href="{{ route('export') }}">
                        <i class="fas fa-users"></i> Export 
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

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
 

    <form action="{{ route('degree.store') }}" method="POST">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="inputName">Code</label>
            <input type="text" id="inputName" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="inputName">Color</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="color:  {{ old('color') }}"><i class="fas fa-square"></i></span>
                </div>
                <input type="text" id="inputName" class="form-control" name="name" value="{{ old('color') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputDescription"> Description</label>
            <textarea id="inputDescription" class="form-control" rows="4" name="description"> {{ old('description') }} </textarea>
        </div>

        <div class="form-group">
            <a href="{{ route('degree.index') }}" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create" class="btn btn-success float-right">
        </div>
    </form>

@endsection
