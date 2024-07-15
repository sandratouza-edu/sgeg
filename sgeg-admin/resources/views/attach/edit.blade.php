@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>attach</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('attach.index') }}">
                            <i class="fas fa-solid fa-arrow-rotate-left"></i> Back
                        </a>
                        <a class="btn btn-app bg-secondary" href="{{ route('attach.create') }}">
                            <i class="fas fa-solid fa-certificate"></i> New
                        </a>
                        <a class="btn btn-app bg-danger" href="{{ route('attach.index') }}">
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
    <form action="{{ route('attach.update', $attach->id) }}" method="POST">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="inputName">uri</label>
            <input type="text" id="uri" class="form-control" name="name" value="{{ $attach->uri }}">
        </div>
        <div class="form-group">
            <label for="keywords">keywords</label>
            <div class="input-group">
                <input type="text" id="keywords" class="form-control" name="keywords" value="{{ $attach->keywords }}">
            </div>
        </div>
        <div class="form-group">
            <label for="description"> Description</label>
            <textarea id="description" class="form-control" rows="4" name="description"> {{ $attach->description }} </textarea>
            <x-adminlte-textarea name="taDesc" label="Description" rows=5 label-class="text-warning" igroup-size="sm"
                placeholder="Insert description...">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-dark">
                        <i class="fas fa-lg fa-file-alt text-warning"></i>
                    </div>
                </x-slot>
            </x-adminlte-textarea>
        </div>

        <div class="form-group">
            <a href="{{ route('attach.index') }}" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Update" class="btn btn-success float-right">
        </div>
    </form>

    
@endsection
