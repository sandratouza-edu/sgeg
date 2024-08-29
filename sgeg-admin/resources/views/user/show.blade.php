@extends('adminlte::page')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Degrees') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('user.index') }}">
                            <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }}
                        </a>
                        <a class="btn btn-app bg-secondary" href="{{ route('user.create') }}">
                            <i class="fas fa-solid fa-certificate"></i> {{ __('New') }}
                        </a>
                        <a class="btn btn-app bg-danger" href="{{ route('user.destroy', $user) }}">
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
            <h3 class="card-title">
                <h3>
                    {{ $user->name }}  

                </h3>
        </div>
        <div class="card-body">
            <h4> {{ $user->dni }} </h4>
            <h4> {{ $user->email }} </h4>
            <h4> {{ $user->dni }} </h4>
            <p> {{ __('Degree') }}: {{ $degrees->find($user->degree_id)->name }}</p>  
            <p> {{ __('Degree') }}: {{ $user->degree->name }}</p>  
        </div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
        <div class="card-body">
            <strong>Roles:</strong>
            @if (!empty($user->getRoleNames()))
                @foreach ($user->getRoleNames() as $v)
                    <label class="badge badge-secondary text-dark">{{ $v }}</label>
                @endforeach
            @endif
        </div>
    </div>

@endsection
