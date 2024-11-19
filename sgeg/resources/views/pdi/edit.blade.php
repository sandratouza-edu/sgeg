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

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pdi.update', $pdi->id) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <x-adminlte-input name="name" label="{{ __('Name') }}" placeholder="{{ __('Name and surname') }}" value="{{ $pdi->user->name }}"
                            label-class="text-lightblue">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                     
                    <div class="form-group">
                        <x-adminlte-input name="email" label="{{ __('Email') }}" placeholder="example@example.com"  value="{{ $pdi->user->email }}"
                            label-class="text-lightblue">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-envelope text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                    <div class="form-group">
                        <x-adminlte-input name="phone" label="{{ __('Phone') }}" placeholder="{{ __('Phone') }}"  value="{{ $pdi->user->phone }}"
                            label-class="text-lightblue">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-phone text-lightblue"></i>
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
                            $selected = $pdi->user->degree_id
                        @endphp
                        <x-adminlte-select id="degree" name="degree_id" label="{{ __('Degree') }}" label-class="text-lightblue">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-certificate text-lightblue"></i>
                                </div>
                            </x-slot>
                            
                            <x-adminlte-options :options="$options" :selected="$selected" empty-option="{{ __('Select an option...') }}" />
                        </x-adminlte-select>
                    </div>
                    <div class="form-group">
                        <x-adminlte-input name="thesis_date" label="{{ __('Thesis Date') }}" placeholder="aaaa-mm-dd"  value="{{ $pdi->thesis_date }}"
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
                            $options2 = [];
                            foreach ($degrees as $degree) {
                                if ($degree->active == 1) {
                                    $options2[$degree->id] = $degree->name; 
                                }
                            }
                            $selected2 = $pdi->is_godfather
                        @endphp
                        <x-adminlte-select id="is_godfather" name="is_godfather" label="{{ __('Godfather') }}" label-class="text-lightblue">
                            <x-slot name="prependSlot"> 
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-graduation-cap text-lightblue"></i>
                                </div>
                            </x-slot>                
                            <x-adminlte-options :options="$options2" :selected="$selected2" empty-option="{{ __('Select an option...') }}" />
                        </x-adminlte-select> 
                    </div>
                    <div class="form-group">
                        {{ Form::hidden('role', "pdi") }}
                        <a href="{{ route('pdi.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        <input type="submit" value="{{ __('Update') }}" class="btn btn-success float-right">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
