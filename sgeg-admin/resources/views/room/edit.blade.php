@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Invitation') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('room.index') }}">
                            <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }}
                        </a>
                        <a class="btn btn-app bg-secondary" href="{{ route('room.create') }}">
                            <i class="fas fa-solid fa-mobile"></i> {{ __('New') }}
                        </a>
                        <a class="btn btn-app bg-danger" href="{{ route('room.index') }}">
                            <i class="fas fa-trash"></i> {{ __('Delete') }}
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
    <form action="{{ route('room.update', $room->id) }}" method="POST">
        @method('put')
        @csrf
        
        <div class="form-group">
            <label for="name"> {{ __('Name') }} </label>
            <input type="text" id="name" class="form-control" name="name" value="{{ $room->name }}">
        </div>
       
       
        <div class="form-group">
            <div class="card p-4">
                <label for="structure"> {{ __('Structure') }}</label>
                <textarea id="structure" class="form-control" rows="4" name="structure"> 
                  {{ json_encode($room->structure, JSON_PRETTY_PRINT)  }} 
                </textarea>
    
           
            </div>
        </div>

        <div class="form-group">
            <a href="{{ route('room.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
            <input type="submit" value="{{ __('Update') }}" class="btn btn-success float-right">
        </div>
    </form>

    
@endsection
   
