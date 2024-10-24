@extends('adminlte::page')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Staircase') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('settings') }}">
                            <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }} 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('plugins.BsCustomFileInput', true)

@section('content')
    <div>
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="name"> {{ __('Title') }} </label>
                <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
            </div>
           
            <div class="form-group">
                <div class="card p-4">
                    <label for="description"> {{ __('Text') }} </label>
                    <textarea id="summernote" class="summernote form-control" rows="4" name="description"> {{ old('description') }} </textarea>               
                </div>
            </div>
            <div class="form-group">
                <a href="{{ route('attachment.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                {{ Form::hidden('user_id', Auth::user()->id) }}
                {{ Form::hidden('type', "doc") }}
                <input type="submit" value="{{ __('Create') }}" class="btn btn-success float-right">
            </div>
        </form>

    </div>

@endsection


@section('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote(
            {
                tabsize: 2,
                height: 340,
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
