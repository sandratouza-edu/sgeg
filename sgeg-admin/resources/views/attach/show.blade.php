@extends('adminlte::page')


@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Titulaciones</h2>
            </div>
            <div class="col-sm-6">
                <div class="btn-group float-sm-right">
                    <a class="btn btn-app bg-secondary" href="{{ route('attach.index') }}">
                        <i class="fas fa-solid fa-arrow-rotate-left"></i> Back 
                    </a>
                    <a class="btn btn-app bg-secondary" href="{{ route('attach.create') }}">
                        <i class="fas fa-solid fa-certificate"></i> New 
                    </a>
                    <a class="btn btn-app bg-danger" href="{{ route('attach.index') }}">                            
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
            <h3 class="card-title"> {{ $attach->name }}  </h3>
             
        </div>
        <div class="card-body">
            {!! html_entity_decode( $attach->description) !!}
            <h4>  
                <a href="{{ $attach->uri }}" class="btn btn-info"  > Descargar </a>
                <a href="{{ route('sendmail') }}" class="btn btn-info"  > Enviar </a>
            </h4>
        </div>

        <div class="card-footer">
             
        </div>

    </div>
@endsection
 