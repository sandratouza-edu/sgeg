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
                        <a class="btn btn-app bg-green" href="{{ route('garment.create') }}">
                            <i class="fas fa-solid fa-user-tie"></i> {{ __('New') }} 
                        </a>                         
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection




@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"> 
                {{ $garment->name }} 
                @if ($garment->available == 1)
                    <i class="fa fa-solid fa-toggle-on text-green"></i>
                @else
                    <i class="fa fa-solid fa-toggle-off bg-brown"></i>
                @endif
            </h2>            
        </div>
        <div class="card-body">
            
            <h5 name="owner">
                <label for="owner{{ $garment->user_id }}">{{ __('Owner') }}</label> 
                @if (!is_null($garment->user)) {{ $garment->user->name}} @endif
            </h5>
            <h5 name="color">
                <label for="description">{{ _('Description')}}</label>
                {{ $garment->description }} 
                
            </h5>
            <h5 name="color">
                <label for="color">{{ __('Color') }}</label>
                {{ $garment->color }} <span style="color:  {{ $garment->color }}"><i class="fas fa-square"></i></span>
                
            </h5>
            <h5 name="height">
                <label for="height">{{ __('Height') }}</label>
                {{ $garment->height }}
            </h5>
            <h5 name="width">
                <label for="width">{{ __('Width') }}</label>{{ $garment->width }}
            </h5>
            <h5 name="waist">
                <label for="description">{{ __('Waist') }}</label>
                {{ $garment->waist }}
            </h5>
            @if ($garment->with_cap == 1)
            <h5 name="width_cap">
                <label for="width_cap">{{ __('With Cap') }}</label>
                
                    <span class="text-green">
                        <i class="fa fa-solid fa-graduation-cap"></i>
                    </span>
                    <label for="description">{{ __('Cap Size') }}: </label>
                    {{ $garment->size_cap }}
            </h5> 
                @endif
            
        </div>

        <div class="card-footer">
            <i class="fa fa-solid fa-toggle-on text-green"></i> = Not avalilable
            <i class="fa fa-solid fa-toggle-off text-brown"></i> = Avalilable
        </div>

    </div>
@endsection

 