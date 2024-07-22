@extends('adminlte::page')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>{{ __('Email') }}</h2>
            </div>
            <div class="col-sm-6">
                <div class="btn-group float-sm-right">
                    <a class="btn btn-app bg-secondary" href="{{ route('attach.create') }}">
                        <i class="fas fa-solid fa-certificate"></i> {{ __('New') }} 
                    </a>
                    <a class="btn btn-app bg-danger">
                        <i class="fas fa-inbox"></i> {{ __('Delete') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="form-group">
    <label for="name"> Para </label>
    <input type="text" id="to" class="form-control" name="to" value=" ">
</div>
<div class="form-group">
    <label for="name"> Asunto </label>
    <input type="text" id="title" class="form-control" name="title" value=" ">
</div>
<div class="form-group">
    <div class="card p-4">
        <textarea id="summernote" class="summernote form-control" rows="8" name="description">  </textarea>
    </div>
</div>
@endsection

@section('js')
    @if (session('message'))
        <script>
            $(document).ready(function() {
                let message = "{{ session('message') }}";
                Swal.fire({
                    title: "Action",
                    text: message,
                    icon: "success",
                })
            });
        </script>
    @endif
 
 
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
    