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
                    <a class="btn btn-app bg-secondary" href="{{ route('attachment.index') }}">
                        <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }} 
                    </a>                   
                    <a class="btn btn-app bg-yellow" href="{{ asset($attachment->uri) }}">
                        <i class="fas fa-download"></i> {{ __('Download') }}
                    </a>
                    <a class="btn btn-app bg-blue" href="{{ route('email', $attachment->id) }}">
                        <i class="fas fa-envelope"></i> {{ __('Send') }}
                    </a>
                    <a class="btn btn-app bg-danger" href="{{ route('attachment.index') }}">                            
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
            <h3 class="card-title"> {{ $attachment->name }}  </h3>
             
        </div>
        <div class="card-body">
            {!! html_entity_decode( $attachment->description) !!}
            <h4>  
                @if( !empty($attachment->uri))
                    <a href="{{ asset($attachment->uri) }}" class="btn btn-info"  > {{ __('Download') }} </a>
                    <a href="{{ route('email', $attachment->id) }}" class="btn btn-info bg-green" > {{ __('Send') }} </a>
                @endif
            </h4>
        </div>

        <div class="card-footer">
        </div>
    </div>
@endsection
 