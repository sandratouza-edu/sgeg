@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Roles y permisos</h2>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </section>
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h4> ROL: {{ $role->name }}</h4>
        </div>
        <div class="card-body">
            <h5>Permisos</h5>
            {!! Form::model($role, ['route' => ['role.update', $role], 'method' => 'put']) !!}
            @foreach ($permissions as $permission)
                <div>
                    <label>
                        {!! Form::checkbox('permissions[]', $permission->id, $role->hasPermissionTo($permission->id) ? : false, ['class' => 'mr-1']) !!}
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
            {!! Form::submit('Asignar permisos', ['class' => 'btn btn-secondary mt-3']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
