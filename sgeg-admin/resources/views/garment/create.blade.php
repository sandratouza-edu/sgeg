@extends('adminlte::page')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Trajes</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('garment.index') }}">
                            <i class="fas fa-rotate-left"></i> Back
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

    <div>
        <form action="{{ route('garment.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" id="inputName" class="form-control" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" class="form-control" name="description" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="available">Available</label>
                <input type="checkbox" name="available" class="" />
            </div>
            <div class="form-group">
                <label for="description">Height</label>
                <input type="text" name="height" class="form-control" value="{{ old('height') }}" />
            </div>
            <div class="form-group">
                <label for="description">width</label>
                <input type="text" name="width" class="form-control" value="{{ old('width') }}" />
            </div>
            <div class="form-group">
                <label for="description">waist</label>
                <input type="text" name="waist" class="form-control" value="{{ old('waist') }}" />
            </div>
            <div class="form-group">
                <label for="description">color</label>
                <input type="text" name="color" class="form-control" value="{{ old('color') }}" />
            </div>
            <div class="form-group">
                <label for="width_cap">width cap</label>
                <input type="checkbox" name="width_cap" class="" />
            </div>
            <div class="form-group">
                <label for="description">size_cap</label>
                <input type="text" name="size_cap" class="form-control" value="{{ old('size_cap') }}" />
            </div>
            <div class="form-group">
                <label for="description">Propietario</label>
                <select name="type">
                    @foreach ($pdis as $pdi)
                        <option value="{{ $pdi->id }}">{{ $pdi->name }} </option>
                        </label>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <a href="{{ route('garment.index') }}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Create" class="btn btn-success float-right">
            </div>
        </form>

    </div>
@endsection
