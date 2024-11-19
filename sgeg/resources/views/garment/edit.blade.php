@extends('adminlte::page')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Academic Garment') }} </h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('garment.index') }}">
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
            <form action="{{ route('garment.update', $garment->id) }}" method="POST">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="inputName">{{ __('Name') }}</label>
                            <input type="text" id="inputName" class="form-control" name="name"
                                value="{{ $garment->name }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="user_id">{{ __('Owner') }} </label> 
                            <select name="user_id" class="custom-select">
                                @foreach ($owners as $user)
                                    <option value="{{ $user->id }}" @if ($user->id == $garment->user_id) selected @endif>{{ $user->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">                             
                                <x-adminlte-input-color label="{{ __('Color') }}" name="color" label-class="text-secondary"  value="{{ $garment->color }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-lg fa-square"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input-color>                            
                        </div>
                        
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                {{Form::hidden('available',0)}}
                                <input class="custom-control-input" type="checkbox" id="available" name="available"
                                value="1"  @if ($garment->available == 1) checked  @endif>
                                <label for="available" class="custom-control-label">{{ __('Available') }}</label> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                {{Form::hidden('with_cap',0)}}
                                <input class="custom-control-input" type="checkbox" id="with_cap" name="with_cap"
                                    value="1" @if ($garment->with_cap == 1) checked @endif>
                                <label for="with_cap" class="custom-control-label">{{ __('With Cap') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="size_Cap">{{ __('Cap Size') }}</label>
                            <input type="text" name="size_cap" class="form-control" value="{{ $garment->size_cap }}" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="height">{{ __('Height') }}</label>
                            <input type="text" name="height" class="form-control" value="{{ $garment->height }}" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="width">{{ __('Width') }}</label>
                            <input type="text" name="width" class="form-control" value="{{ $garment->width }}" />
                            <p></p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="waist">{{ __('Waist') }}</label>
                            <input type="text" name="waist" class="form-control" value="{{ $garment->waist }}" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <textarea id="inputDescription" class="form-control" rows="4" name="description"> {{ $garment->description }} </textarea>
                </div>

                <div class="form-group">
                    <a href="{{ route('garment.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
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

@endsection
