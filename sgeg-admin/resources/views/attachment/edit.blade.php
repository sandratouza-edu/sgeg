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
                        <a class="btn btn-app bg-yellow" href="{{ asset($attachment->uri) }}">
                            <i class="fas fa-download"></i> {{ __('Download') }}
                        </a>
                        <a class="btn btn-app bg-blue" href="{{ route('attachment.show', $attachment->id) }}">
                            <i class="fas fa-eye"></i> {{ __('Preview') }}
                        </a>
                        <a class="btn btn-app bg-green" href="{{ route('attachment.create') }}">
                            <i class="fas fa-solid fa-mobile"></i> {{ __('New') }}
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
    <form action="{{ route('attachment.update', $attachment->id) }}" method="POST">
        @method('put')
        @csrf
        
        <div class="form-group">
            <label for="name"> {{ __('Name') }} </label>
            <input type="text" id="name" class="form-control" name="name" value="{{ $attachment->name }}">
        </div>
        <div class="form-group">
            <label for="inputName">{{ __('URI') }} </label>
            <input type="text" id="uri" class="form-control" name="uri" value="{{ $attachment->uri }}" readonly>
        </div>
        <div class="form-group">
            <label for="keywords">{{ __('Keywords') }}</label>
            <div class="input-group">
                <input type="text" id="keywords" class="form-control" name="keywords" value="{{ $attachment->keywords }}">
            </div>
        </div>
       
        <div class="form-group">
            <div class="card p-4">
                <label for="description"> {{ __('Text') }}</label>
                <textarea id="summernote" class="summernote form-control" rows="14" name="description"> {{ $attachment->description }} </textarea>
    
              
            </div>
        </div>

        <div class="form-group">
            <a href="{{ route('attachment.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            <input type="submit" value="{{ __('Update') }}" class="btn btn-success float-right">
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
                height: 320,
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
