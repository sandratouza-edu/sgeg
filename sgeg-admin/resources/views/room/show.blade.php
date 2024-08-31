@extends('adminlte::page')


@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>{{ __('Room') }}</h2>
            </div>
            <div class="col-sm-6">
                <div class="btn-group float-sm-right">
                    <a class="btn btn-app bg-secondary" href="{{ route('room.index') }}">
                        <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }} 
                    </a>
                    <a class="btn btn-app bg-secondary" href="{{ route('room.create') }}">
                        <i class="fas fa-solid fa-certificate"></i> {{ __('New') }} 
                    </a>
                    <a class="btn btn-app bg-danger" href="{{ route('room.index') }}">                            
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
            <h3 class="card-title"> {{ $room->name }}  </h3>
             
        </div>
        <div class="card-body">
          
            <p>
                @foreach ($room->structure as $key => $value)
                    @if (!is_array($value)) 
                    <p>  {{ $key }} => {{ $value }}    </p>
                    @else
                    <p> {{ $key }} => {{ json_encode($value, JSON_PRETTY_PRINT) }}     </p>
                    @endif

                @endforeach
            </p> 
            <p>
                @isset($room->structure['numareas'] )
                   Areas: {{ $room->structure['numareas'] }}
                @endisset
            </p>
        </div>

        <div class="card-footer">
            <pre> {{ json_encode($room->structure, JSON_PRETTY_PRINT)  }} </pre>
             
        </div>

    </div>
@endsection
 