@extends('adminlte::page')

@section('css')
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
@endsection

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
        @csrf
        <div class="form-group">
            <label for="name"> Name </label>
            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="keywords">keywords</label>
            <div class="input-group">
                <div class="input-group-prepend">
                </div>
                <input type="text" id="keywords" class="form-control" name="keywords" value="{{ old('keywords') }}">
            </div>
        </div>

        <div class="form-group">
            <select name="type">
                <option value="doc" selected>Documento</option>
                <option value="image" >Imagen</option>
              </select>
        </div>
        <div class="form-group">
            <div class="card p-4">
                <label for="description"> Description</label>
                <textarea id="summernote" class="summernote form-control" rows="4" name="description"> {{ old('description') }} </textarea>

            <div class="form-group">
                <a id="edit" class="btn btn-info" onclick="edit()">Edit</a>
                <a id="save" class="btn btn-info" onclick="save()">Preview</a>
            </div>
            </div>
        </div>
        <div class="form-group">
            <a href="{{ route('attach.index') }}" class="btn btn-secondary">Cancel</a>
            {{ Form::hidden('user_id', Auth::user()->id) }}
            <input type="submit" value="Create" class="btn btn-success float-right">
        </div>
    </form>


@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote(
                {
                    tabsize: 2,
                    height: 140,
                    lang: 'es-ES' 
                }
            );
        });
        var edit = function() {
            $('#summernote').summernote({focus: true});
            };

        var save = function() {
            var markup = $('.summernote').summernote('code');
            $('#summernote').summernote('destroy');
            };
    
    </script>
@endsection
