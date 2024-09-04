@extends('layouts.app')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('User') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <div class="btn-group float-sm-right">
                            <a class="btn btn-app bg-secondary" href="{{ route('user.index') }}">
                                <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }}
                            </a>
                        </div>
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
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <x-adminlte-input name="name" label="{{ __('Name') }}" placeholder="{{ __('Name and surname') }}" required
                        label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="form-group">
                    <x-adminlte-input name="dni" label="{{ __('DNI') }}" placeholder="{{ __('DNI') }}" 
                    label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-idcard text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                </div>
                <div class="form-group">
                    <x-adminlte-input name="email" label="{{ __('Email') }}" placeholder="example@example.com" required
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
                <x-adminlte-input name="phone2" label="{{ __('Phone') }} 2"  
                    label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fab fa-telegram-plane"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                </div>
                <div class="form-group">
                    @role('admin')
                        <label for="name" class="text-lightblue"> {{ _('ROLES') }} </label>
                        <div class="card">                          
                            <div class="card-body">
                                @foreach ($roles as $role)
                                    <div>
                                        <label>
                                            {!! Form::checkbox('roles[]', $role->name, null, ['class' => 'mr-1']) !!}
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endrole
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
                        
                        <x-adminlte-options :options="$options" empty-option="{{ __('Select an option...') }}" />
                    </x-adminlte-select>
                </div>
                <div class="form-group">
                    <!--label for="image">Image</label -->
                    <p> </p>
                    {{-- With prepend slot, lg size, and label --}}
                </div>
                <div class="form-group">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Create" class="btn btn-success float-right">
                </div>
            </form>

        </div>
    </div>
@endsection
