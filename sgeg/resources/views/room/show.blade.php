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
                    <a class="btn btn-app bg-green" href="{{ route('room.create') }}">
                        <i class="fas fa-solid fa-certificate"></i> {{ __('New') }} 
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
            <h2> {{ $room->name }}  </h2>
        </div>
        <div class="card-body">
            @php($seat = 0)
            <p>
                @isset($room->structure['numareas'] )
                <label for="">Areas: {{ $room->structure['numareas'] }} </label>
                    @foreach ($room->structure['areas'] as $area)
                    <div class="row">
                        @isset($area['numsections'] )
                            @foreach ($area['sections'] as $index=>$section)
                                @if ($index < $area['numsections']/2)
                                    <div class="col-{{ 12/$area['numsections'] }} d-flex align-items-center flex-column">
                                        <label for="">Seccion {{ $index+1 }} - Derecha </label>                                                                          
                                        @for ($i = 1; $i <= $section['rows'] ; $i++) 
                                            <div class="seatRow"> 
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <label for="">Fila {{ $section['rows']-$i+1 }} </label>
                                                    @for ($j = 1; $j <= $section['cols']-$i; $j++) 
                                                        <div id="{{ $i }}_{{ $j }}" data-desc="col: {{ $section['cols'] }} - row : {{ $section['rows'] }}"  value="{{ $seat++ }}" role="checkbox" data-toggle="modal" data-target="#modalAssign" title="{{ _('Free') }}" aria-checked="false" focusable="true" tabindex="-1" class="seatNumber">
                                                        {{ $j }}
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                @else
                                    <div class="col-{{ 12/$area['numsections'] }} d-flex align-items-center flex-column">
                                        <label for="">Seccion {{ $index+1 }} - Izquierda</label>                                                                            
                                        @for ($i = 1; $i <= $section['rows'] ; $i++) 
                                            <div class="seatRow">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <label for="">Fila {{ $section['rows']-$i+1 }} </label>
                                                    @for ($j = 1; $j <= $section['cols']-$i; $j++) 
                                                        <div id="{{ $i }}_{{ $j }}" role="checkbox" data-toggle="modal" data-target="#modalAssign" title="{{ _('Free') }}" value="{{ $seat++ }}" aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber ">
                                                        {{ ($j) }}
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                @endif
                            @endforeach
                        @endisset
                    </div>

                    @endforeach
                @endisset
            </p>
        </div>

        <div class="card-footer secondary">
            <div class="card secondary">
                <div class="card-body bg-dark text-white">
                    <h3>Estructura</h3>

                    @foreach ($room->structure as $key => $value)
                        @if (!is_array($value)) 
                            <pre class="text-white"> <label for="">{{ $key }} </label> => {{ $value }}    </pre>
                        @endif
                    @endforeach
                    <pre class="text-white"> {{ json_encode($room->structure, JSON_PRETTY_PRINT)  }} </pre>
                </div> 

            </div>
        </div>

    </div>
@endsection
 

@section('css')
<link rel="stylesheet" href="/assets/css/seats.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endsection
