@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Degrees') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('degree.index') }}">
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
            <form action="{{ route('degree.update', $degree->id) }}" method="POST">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="inputName">{{ __('Code') }}</label>
                            <input type="text" id="inputName" class="form-control" name="name"
                                value="{{ $degree->name }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="inputName">{{ __('Color') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="color:  {{ $degree->color }}">
                                        <i class="fas fa-square"></i>
                                    </span>
                                </div>
                                <input type="text" id="inputColor" class="form-control" name="color"
                                    value="{{ $degree->color }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">   
                        <div class="col-4">
                            <div class="form-group">
                                <label for="inputName">{{ __('Status') }}</label>
                                {{Form::hidden('active',0)}}  
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="active" name="active"
                                        value="1" @if ($degree->active == 1) checked @endif>
                                    <label for="active" class="custom-control-label"> </label> 
                                </div>
                            </div>
                        </div>                     
                         
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputDescription"> {{ __('Description') }}</label>
                    <textarea id="inputDescription" class="form-control" rows="4" name="description"> {{ $degree->description }} </textarea>
                </div>

                <div class="form-group">
                    <a href="{{ route('degree.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    <input type="submit" value="{{ __('Update') }}" class="btn btn-success float-right">
                </div>
            </form>
        </div>
    </div>

@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css"
        rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js">
    </script>
    <script>
        $('#inputColor').colorpicker();
    </script>
@endsection
