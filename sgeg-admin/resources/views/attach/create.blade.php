@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Cards and Invitations</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary">
                            <i class="fas fa-user"></i> New
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


    <form action="{{ route('attach.store') }}" method="POST">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="uri">URI / Name </label>
            <input type="text" id="uri" class="form-control" name="uri" value="{{ old('uri') }}">
        </div>
        <div class="form-group">
            <label for="keywords">keywords</label>
            <div class="input-group">
                <div class="input-group-prepend">
                </div>
                <input type="text" id="keywords" class="form-control" name="name" value="{{ old('keywords') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="description"> Description</label>
            <textarea id="description" class="form-control" rows="4" name="description"> {{ old('description') }} </textarea>
            <x-adminlte-textarea name="taDesc" label="Description" rows=5 label-class="text-warning" igroup-size="sm"
                placeholder="Insert description...">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-dark">
                        <i class="fas fa-lg fa-file-alt text-warning"></i>
                    </div>
                </x-slot>
            </x-adminlte-textarea>
            <hr>
            <div id="summernote"></div>
            <hr>
        </div>

        <div class="form-group">
            <a href="{{ route('attach.index') }}" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create" class="btn btn-success float-right">
        </div>
    </form>


@endsection
