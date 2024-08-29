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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('content')
    @php
        if (session()) {
            if (session('message') == 'success') {
                echo '<x-adminlte-alert class="bg-teal text-uppercase" icon="fa fa-lg fa-thumbs-up" title="Done" dismissable>
                    complete!
                </x-adminlte-alert>';
            }
        }
    @endphp
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pdi.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <x-adminlte-input name="name" label="{{ __('Name') }}" placeholder="{{ __('Name and surname') }}"
                        label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="form-group">
                    <x-adminlte-input name="email" label="{{ __('Email') }}" placeholder="example@example.com"
                        label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-envelope text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="form-group">
                    <x-adminlte-input name="phone" label="{{ __('Phone') }}" placeholder="{{ __('Phone') }}"
                        label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-phone text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="form-group">
                    <x-adminlte-input name="thesis_date" label="{{ __('Date') }}" placeholder="aaaa-mm-dd"
                        label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-calendar text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="form-group">  
                    @php
                        $options = [];
                        foreach ($degrees as $degree) {
                            $options[$degree->id] = $degree->name;
                        }
                    @endphp
                    <x-adminlte-select id="degree" name="degree_id" label="{{ __('Degree') }}" label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-lg fa-certificate text-lightblue"></i>
                            </div>
                        </x-slot>
                        
                        <x-adminlte-options :options="$options"  empty-option="{{ __('Select an option...') }}" />
                    </x-adminlte-select>
                </div>

                <div class="form-group">
                    {{ Form::hidden('role', "pdi") }}
                    <a href="{{ route('pdi.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    <input type="submit" value="{{ __('Create') }}" class="btn btn-success float-right">
                </div>
            </form>
        </div>
    </div>
@endsection