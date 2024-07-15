@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Garments</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('garment.index') }}">
                            <i class="fas fa-solid fa-arrow-rotate-left"></i> Back
                        </a>
                        <a class="btn btn-app bg-secondary" href="{{ route('garment.create') }}">
                            <i class="fas fa-solid fa-user-tie"></i> New
                        </a>
                        <a class="btn btn-app bg-danger" href="{{ route('garment.index') }}">
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
            <h3 class="card-title"> {{ $garment->name }}
                @if ($garment->avaliable)
                    <i class="fa fa-solid fa-lightbulb bg-green"></i>
                @else
                    <i class="fa fa-solid fa-lightbulb bg-brown"></i>
                @endif
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <h4 name="owner">
                <label for="width">Owner</label> {{ $garment->owner }}
            </h4>
            <h4 name="height">
                <label for="height">Height</label>
                {{ $garment->height }}
            </h4>
            <h4 name="width">
                <label for="width">width</label>{{ $garment->width }}
            </h4>
            <h4 name="waist">
                <label for="description">waist</label>
                {{ $garment->waist }}
            </h4>
            <h4 name="color">
                <label for="description">color</label>
                <span style="color:  {{ $garment->color }}"><i class="fas fa-square"></i></span>
                {{ $garment->color }}
            </h4>
            <h4 name="width_cap">
                <label for="width_cap">with cap</label>
                @if ($garment->width_cap)
                    <i class="fa-solid fa-graduation-cap bg-green"></i>
                @else
                    <i class="fa fa-solid fa-lightbulb bg-brown"></i>
                @endif
            </h4>
            <h4 name="size_cap">
                <label for="description">size_cap</label>
                {{ $garment->size_cap }}
            </h4>
        </div>

        <div class="card-footer">
            <i class="fa fa-solid fa-lightbulb bg-brown"></i> = Not avalilable
            <i class="fa fa-solid fa-lightbulb bg-brown"></i> = Avalilable
        </div>

    </div>
@endsection

 