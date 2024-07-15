@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>PDI</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('pdi.index') }}">
                            <i class="fas fa-solid fa-arrow-rotate-left"></i> Back
                        </a>
                        <a class="btn btn-app bg-secondary" href="{{ route('pdi.create') }}">
                            <i class="fas fa-solid fa-certificate"></i> New
                        </a>
                        <a class="btn btn-app bg-danger" href="{{ route('pdi.index') }}">
                            <i class="fas fa-inbox"></i> Delete
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
            <h3 class="card-title"> {{ $pdi->name }} -{{ $pdi->surname }} </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <h4> {{ $pdi->dni }} </h4>
            <h4> {{ $pdi->email }} </h4>
        </div>

        <div class="card-footer">

        </div>

    </div>
@endsection
