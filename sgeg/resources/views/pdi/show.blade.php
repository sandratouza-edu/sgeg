@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('PDI') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('pdi.index') }}">
                            <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }}
                        </a>
                        <a class="btn btn-app bg-green" href="{{ route('pdi.create') }}">
                            <i class="fas fa-solid fa-certificate"></i> {{ __('New') }}
                        </a>
                        <a class="btn btn-app bg-danger" href="{{ route('pdi.index') }}">
                            <i class="fas fa-inbox"></i> {{ __('Delete') }}
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
            <h4> <label class="text-gray">{{ __('Name') }}:  </label> {{ $pdi->user->name }} </h4>
            <h5> <label class="text-gray">{{ __('Email') }}:  </label> {{ $pdi->user->email }}   </h5>
            <h5> <label class="text-gray">{{ __('Degree') }}: </label>  
                @if (!is_null($pdi->user->degree_id) &&  ($pdi->user->degree_id >0) )
                    {{ $degrees->find($pdi->user->degree_id)->name }} 
                @endif
            </h5>  
            <h5> <label class="text-gray">{{ __('Thesis') }}:  </label> {{ $pdi->thesis_date }} </h5>
            <p>  
                @component('components.telegram-button', ['phone' => $pdi->user->phone])
                @endcomponent
            </p>
            <h5> 
                @if ($pdi->is_godfather > 1 )
                <label class="text-gray">
                    {{ __('Godfather') }}:  
                </label> {{ $pdi->is_godfather }} - {{ $degrees->find($pdi->is_godfather)->name }}
                @endif
            </h5>
        </div>

        <div class="card-footer">

        </div>

    </div>
@endsection
