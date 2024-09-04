@extends('adminlte::page')

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('User') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('user.index') }}">
                            <i class="fas fa-solid fa-reply-all"></i> {{ _('Back') }}
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
        <h2>{{ __('Edit') }}</h2>
    </div>
    <div class="card-body">
        {!! Form::model($user, ['route' => ['user.update', $user], 'method' => 'put']) !!}
        @method('put')
        @csrf
    <div class="form-group">
        <x-adminlte-input name="name" label="Nombre y Apellidos" value="{{ $user->name }}" required
                        label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
    </div>
    <div class="form-group">
        <x-adminlte-input name="dni" label="DNI" value="{{ $user->dni }}"
        label-class="text-lightblue">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-id-card text-lightblue"></i>
            </div>
        </x-slot>
    </x-adminlte-input>
    </div>
    <div class="form-group">
        <x-adminlte-input name="email" label="Email"  value="{{ $user->email }}" required
        label-class="text-lightblue">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <a href="{{ route('sendmail') }}"> 
                <i class="fas fa-envelope text-lightblue"></i> 
                </a>
            </div>
        </x-slot>
    </x-adminlte-input>
    </div>
    <div class="form-group">
        <x-adminlte-input name="phone" label="{{ __('Phone') }}" value="{{ $user->phone }}"
        label-class="text-lightblue">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fab fa-telegram-plane"></i>
            </div>
        </x-slot>
        </x-adminlte-input>
        <x-adminlte-input name="phone2" label="{{ __('Phone') }} 2" value="{{ $user->phone2 }}"
            label-class="text-lightblue">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fab fa-telegram-plane"></i>
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
            
            <x-adminlte-options :options="$options"  :selected="$user->degree_id"  empty-option="{{ __('Select an option...') }}" />
        </x-adminlte-select>
    </div>
    <div class="form-group">
        @role('admin')
        <label for="name" class="text-lightblue"> {{ _('ROLES') }} </label>
        <div class="card">
            <div class="card-body">
                @foreach ($roles as $role)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, $user->hasAnyRole($role->id) ?: false, ['class' => 'mr-1']) !!}
                            {{ Str::upper($role->name) }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        @endrole
    </div>
    
    <div class="form-group">
        <input type="submit" value="{{ __('Update') }}" class="btn btn-success float-right">
        {!! Form::close() !!}
    </div>
        </div>
    </div>
    <p> </p>
 
@endsection

@section('js')
    @if (session('message'))
        <script>
            $(document).ready(function() {
                let message = "{{ session('message') }}";
                Swal.fire({
                    title: "{{ __('Action') }}",
                    text: message,
                    icon: "success",
                })
            });
        </script>
    @endif
@endsection
