@extends('layouts.app')

@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@section('content')

<div>
    <h2>{{ __('Edit') }} {{ __('Student') }}</h2>

    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @method('put')
        @csrf
        <label for title>Nombre</label>
        <input type="text" name="name" value="{{ $user->name }}" />
        <p> </p>
        <label for="description">DNI</label>
        <input type="text" name="dni" value="{{ $user->dni }}"/>
        <p> </p>
        <label for="description">Email</label>
        <input type="text" name="email" value="{{ $user->email }}"/>        
       
        <p>  
        <input type="submit" value="Update" /> </p>
        <p> </p>
    </form>

</div>
<p> </p>
<hr>
<a href="{{ route('user.index') }}">Back</a>

@endsection

@section('js')
    @if(session("message"))
    <script>
        $(document).ready(function() {
            let message ="{{ session('message') }}";
            Swal.fire({
                title: "{{ __('Action') }}",
                text: message,
                icon: "success",
            })
        });
    </script>
    @endif
@endsection