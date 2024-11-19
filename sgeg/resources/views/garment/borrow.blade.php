@extends('adminlte::page')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Borrow Garment') }} </h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('garment.index') }}">
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
    <form action="{{ route('garment.borrowSave', $garment->id) }}" method="POST">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="inputName">{{ __('Doctoral student') }}</label>
            <input type="text" id="inputName" readonly class="form-control" name="name" value="{{ auth()->user()->name}}">
            <input type="hidden" id="inputName" class="form-control" name="user_id" value="{{ auth()->user()->id }}">
        </div>
        <div class="form-group">
            <label for="description"> {{ __('Request') }}</label>
            <input type="text" id="description" class="form-control" name="description" value="{{ $garment->name }} Solicitud">
        </div>
        <div class="form-group">
            <label for="garment">{{ __('Garments') }}</label>
            <select name="garment_id"  class="custom-select">
                @foreach ($garments as $garment) 
                    <option value="{{ $garment->id }}">
                        {{ $garment->name }} <i class="fas fa-square" style="color:  {{ $garment->color }}"></i> 
                        - {{ __('Waist') }}: {{ $garment->waist }}  {{ __('Height') }}: {{ $garment->height }}  {{ __('Width') }}: {{ $garment->width }}  @if ($garment->with_cap) {{ __('Cap Size') }}: {{ $garment->size_cap }} @endif  
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="hidden" id="inputName" class="form-control" name="status" value="pending">

            <a href="{{ route('garment.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            <input type="submit" value="{{ __('Borrow') }}" class="btn btn-success float-right">
        </div>
    </form>
@endsection
