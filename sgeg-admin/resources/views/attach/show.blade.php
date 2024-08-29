@extends('adminlte::page')


@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>{{ __('Invitations') }}</h2>
            </div>
            <div class="col-sm-6">
                <div class="btn-group float-sm-right">
                    <a class="btn btn-app bg-secondary" href="{{ route('attach.index') }}">
                        <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }} 
                    </a>                   
                    <a class="btn btn-app bg-yellow" href="{{ $attach->uri }}">
                        <i class="fas fa-download"></i> {{ __('Download') }}
                    </a>
                    <a class="btn btn-app bg-blue" href="{{ route('email', $attach->id) }}">
                        <i class="fas fa-envelope"></i> {{ __('Send') }}
                    </a>
                    <a class="btn btn-app bg-danger" href="{{ route('attach.index') }}">                            
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
        <div class="card-header">
            <h3 class="card-title"> {{ $attach->name }}  </h3>
             
        </div>
        <div class="card-body">
            {!! html_entity_decode( $attach->description) !!}
            <h4>  
                <a href="{{ $attach->uri }}" class="btn btn-info"  > {{ __('Download') }} </a>
                <a href="{{ route('email', $attach->id) }}" class="btn btn-info bg-green" > {{ __('Send') }} </a>
            </h4>
        </div>

        <div class="card-footer">
             
        </div>

    </div>
@endsection
 