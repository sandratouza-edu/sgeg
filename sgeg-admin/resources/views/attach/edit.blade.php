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
            <label for="name"> Name </label>
            <input type="text" id="name" class="form-control" name="name" value="{{ $attach->name }}">
        </div>
        <div class="form-group">
            <label for="inputName">uri <a href="{{ $attach->uri }}" class="btn btn-info"  >Download</a></label>
            <input type="text" id="uri" class="form-control" name="uri" value="{{ $attach->uri }}">
        </div>
        <div class="form-group">
            <label for="keywords">keywords</label>
            <div class="input-group">
                <input type="text" id="keywords" class="form-control" name="keywords" value="{{ $attach->keywords }}">
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
                <textarea id="summernote" class="summernote form-control" rows="4" name="description"> {{ $attach->description }} </textarea>
    
            <div class="form-group">
                <a id="edit" class="btn btn-info" onclick="edit()">Edit</a>
                <a id="save" class="btn btn-info" onclick="save()">Preview</a>
            </div>
            </div>
        </div>

        <div class="form-group">
            <a href="{{ route('attach.index') }}" class="btn btn-secondary">Cancel</a>
        {{ Form::hidden('user_id', Auth::user()->id) }}
            <input type="submit" value="Update" class="btn btn-success float-right">
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
