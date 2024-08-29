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
                            <i class="fas fa-solid fa-envelope"></i> {{ __('New') }}
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
        <x-adminlte-select2 name="rolesG" igroup-size="lg" label-class="text-lightblue"
            data-placeholder=" {{ __('Select') }}...">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-gradient-info">
                    <i class="fas fa-user-tie"></i>
                </div>
            </x-slot>
            <x-adminlte-options :options="['Students', 'PDI', 'Guests']" empty-option />
        </x-adminlte-select2>

        @php
        $options = ['GRAI', 'GREI', 'MIA'];
        @endphp
        <x-adminlte-select id="groups" name="groups[]" label="Grupos" label-class="text-lightblue" multiple>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-gradient-red">
                    <i class="fas fa-lg fa-certificate"></i>
                </div>
            </x-slot>
            <x-adminlte-options :options="$options" />
        </x-adminlte-select>

    </div>
    <div class="form-group">
        <div class="card p-4">
            <label for="description"> {{ __('Text') }} </label>
            <textarea id="summernote" class="summernote form-control" rows="8" name="description">  </textarea>
        </div>
        <input type="submit" value=" {{ __('Send') }}" class="btn btn-success float-right">
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
 