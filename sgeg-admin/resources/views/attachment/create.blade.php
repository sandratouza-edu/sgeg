@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Invitation') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('attachment.index') }}">
                            <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }}
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


    <form action="{{ route('attachment.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name"> {{ __('Name') }} </label>
            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="keywords"> {{ __('Keywords') }} </label>
            <div class="input-group">
                <div class="input-group-prepend">
                </div>
                <input type="text" id="keywords" class="form-control" name="keywords" value="{{ old('keywords') }}">
            </div>
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
                    height: 140,
                    lang: 'es-ES' 
                }
            );
        });
    </script>
@endsection
