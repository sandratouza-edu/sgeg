@extends('adminlte::page')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>{{ __('Image') }}</h2>
            </div>
            <div class="col-sm-6">
                <div class="btn-group float-sm-right">
                    <a class="btn btn-app bg-secondary" href="{{ route('image.index') }}">
                        <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }}
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form action="{{ route('image.uploadSave') }}" method="POST" enctype="multipart/form-data">
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
                <x-adminlte-input-file name="image" igroup-size="sm" placeholder=" file..." value="{{ old('image') }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>
            <div class="form-group">
                <div class="card p-4">
                    <label for="description"> {{ __('Text') }}</label>
                    <textarea id="summernote" class="summernote form-control" rows="4"
                        name="description"> {{ old('description') }} </textarea>
                </div>
            </div>
            <div class="form-group">
                <a href="{{ route('attachment.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>

                <input type="submit" value="{{ __('Create') }}" class="btn btn-success float-right">
            </div>
        </form>
    </div>
</div>
@endsection

@section('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('plugins.BsCustomFileInput', true)

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