@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2> {{ __('Settings') }} </h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('admin') }}">
                            <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('saveSettings') }}" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Settings') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <x-adminlte-input name="site_name" label="{{ __('Site name') }}"  value="{{ $ordered['site_name'] }}" label-class="text-lightblue"/>
                            </div>
                            <div class="form-group"> 
                            <x-adminlte-input name="sender_name" label="{{ __('Sender name') }}" value="{{ $ordered['sender_name'] }}" label-class="text-lightblue"/>                               
                            </div>
                            <div class="form-group">
                                <x-adminlte-input name="admin_email" label="{{ __('Sender email') }}" value="{{ $ordered['admin_email'] }}" label-class="text-lightblue"/>
                            </div>
                            <div class="form-group">
                                <x-adminlte-input name="telegram_token" label="telegram_token" value="{{ $ordered['telegram_token'] }}" 
                                    label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                            <div class="form-group">
                                <x-adminlte-input name="telegram_channel" label="telegram_channel" value="{{ $ordered['telegram_channel'] }}"  
                                    label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                            <div class="form-group">
                                <x-adminlte-input name="pagination" label="{{ __('Items per page') }}" value="{{ $ordered['pagination'] }}" label-class="text-lightblue"/>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Import') }}</h3>
                        </div>
                        <div class="card-body">
                            <h4> {{ __('Column names') }}</h4>
                            <p>{{ __('Write the fields correspondence included in the csv import file') }} </p>
                            <div class="form-group">
                                <x-adminlte-input name="col_name" label="{{ __('Name') }}" value="{{ $ordered['col_name'] }}" label-class="text-lightblue"/>
                                <x-adminlte-input name="col_email" label="{{ __('Email') }}" value="{{ $ordered['col_email'] }}" label-class="text-lightblue"/>
                                <x-adminlte-input name="col_phone" label="{{ __('Phone') }}" value="{{ $ordered['col_phone'] }}" label-class="text-lightblue"/>
                                <x-adminlte-input name="col_phone2" label="{{ __('Phone') }} 2" value="{{ $ordered['col_phone2'] }}" label-class="text-lightblue"/>
                                <x-adminlte-input name="col_dni" label="{{ __('dni') }}" value="{{ $ordered['col_dni'] }}"  label-class="text-lightblue"/>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Invitations') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                @php
                                $paperoptions = ['letter'=>'letter','A4'=>'A4', 'A5'=>'A5', 'A6'=>'A6'];
                                @endphp
                                <x-adminlte-select id="paper" name="paper" label="{{ __('Paper') }}" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-red">
                                            <i class="fas fa-lg fa-tools"></i>
                                        </div>
                                        
                                    </x-slot>
                                    <x-adminlte-options :options="$paperoptions" :selected="$ordered['paper']" />
                                </x-adminlte-select>
                            </div>
                            <div class="form-group">
                                @php
                                $options = ['portrait'=>'portrait', 'landscape'=>'landscape'];
                                @endphp
                                <x-adminlte-select id="orientation" name="orientation" label="{{ __('orientation') }}" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-red">
                                            <i class="fas fa-lg fa-tools"></i>
                                        </div>
                                    </x-slot>
                                    <x-adminlte-options :options="$options" :selected="$ordered['orientation']" />
                                </x-adminlte-select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Import') }} - {{ __('PDI') }}</h3>
                        </div>
                        <div class="card-body">
                            <p>{{ __('Use the same config file than import user') }} </p>
                            {{ Form::hidden('type', "pdi") }}
                            @component('components.csv-form')
                            @endcomponent
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div> 
                <div class="col-md-12 mb-2">
                    <input type="submit" value="{{ __('Update') }}" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </div>
@endsection

@section('plugins.BsCustomFileInput', true)