@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Rooms') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('room.index') }}">
                            <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }}
                        </a>
                        <a class="btn btn-app bg-secondary">
                            <i class="fas fa-solid fa-mobile"></i> {{ __('New') }}
                        </a>
                        <a class="btn btn-app bg-danger">
                            <i class="fas fa-trash"></i> {{ __('Delete') }}
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


    <form action="{{ route('room.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name"> {{ __('Name') }} </label>
            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        
        <div class="form-group">
            <div class="card p-4">
                <label for="description"> {{ __('Estructura') }} </label>
                <textarea id="structure" class="form-control" rows="4" name="structure"> {{ old('structure') }} </textarea>

                <div style="">
                    <blockquote class="quote-orange mt-0">
                        <h5>Aviso!</h5>
                        <p>{{ _('Must have a json estructure similar to the next example') }}</p>
                        <p>{{ _('Must define areas, sections rows and cols') }}</p>

                        <p>{{ _('Example') }} <a href="/public/assets/room-example.json"></a> estructura en Json</p>
                        <div class="language-html max-height-300 highlighter-rouge">
                            {
                                "numareas": 2, 
                                "description": "se define areas, secciones y filas por columnas"
                                "areas": 
                                    [{"name": "area1", 
                                              "sections": [{"cols": 10, "name": "section 1", "rows": "10"}, {"cols": 10, "name": "section 2", "rows": "10"}, {"cols": 10, "name": "section 3", "rows": "10"}, {"cols": 10, "name": "section 4", "rows": "10"}], 
                                              "numsections": "4"}, 
                                     {"name": "area2", 
                                            "sections": [{"cols": 15, "name": "section 1", "rows": "10"}, {"cols": 15, "name": "section 2", "rows": "10"}], 
                                            "numsections": "2"}]
                            }
                        </div>
                        </blockquote>
                </div>

            </div>
        </div>
        <div class="form-group">
            <a href="{{ route('room.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
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
        var edit = function() {
            $('#summernote').summernote({focus: true});
            };

        var save = function() {
            var markup = $('.summernote').summernote('code');
            $('#summernote').summernote('destroy');
            };
    
    </script>
@endsection
