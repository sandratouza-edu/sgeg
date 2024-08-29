@extends('adminlte::page')


@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2> {{ __('Degrees') }}</h2>
            </div>
            <div class="col-sm-6">
                <div class="btn-group float-sm-right">
                    <a class="btn btn-app bg-secondary" href="{{ route('degree.index') }}">
                        <i class="fas fa-solid fa-reply-all"></i>  {{ __('Back') }} 
                    </a>
                    <a class="btn btn-app bg-secondary" href="{{ route('degree.create') }}">
                        <i class="fas fa-solid fa-certificate"></i>  {{ __('New') }} 
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
            <h3 class="card-title"> {{ $degree->name }}  </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <h4>  {{ __('Title') }}: {{ $degree->description }} </h4>
            <h4>  {{ __('Color') }}:  
                <span style="color:  {{ $degree->color }}"><i class="fas fa-square"></i></span>
                {{ $degree->color }} 
            </h4>
        </div>

        <div class="card-footer">
             
        </div>

    </div>
@endsection
 