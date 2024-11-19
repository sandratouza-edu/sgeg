@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Roles') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('role.index') }}">
                            <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
	<link rel="stylesheet" href="/css/custom.css">
@endsection

@section('content')

<style>

#columns{
   column-count:4;
   column-gap:20px;
   list-style: none;
}

</style>
    <div class="card">
        <div class="card-header">
            <h4> ROL: {{ $role->name }}</h4>
        </div>
        <div class="card-body">
            <h5>Permisos</h5>
            {!! Form::model($role, ['route' => ['role.update', $role], 'method' => 'put']) !!}
            <ul id="columns">
                @foreach ($permissions as $permission)
                    <li>
                        <label>
                            {!! Form::checkbox('permissions[]', $permission->id, $role->hasPermissionTo($permission->id) ? : false, ['class' => 'mr-1']) !!}
                            {{ $permission->name }}
                        </label>
                    </li>
                @endforeach
            </ul>
            {!! Form::submit('Asignar permisos', ['class' => 'btn bg-green mt-3']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
