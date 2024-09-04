@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Message via telegram') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary"  >
                            <i class="fas fa-solid fa-envelope"></i> {{ __('New') }}
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="form-group">
    <x-adminlte-modal id="modalMessage" title="Message" theme="secondary" icon="fab fa-telegram-plane" size='lg' disable-animations>
        <form action="{{ route('sendmail') }}" method="POST">
            @csrf
            <x-adminlte-input name="message" label="message" placeholder="{{ __('Message') }}" label-class="text-grey">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-grey"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <a href="tg://msg?text=Hooooola&to=672913850">prueba</a>
            <x-adminlte-button type="Submit" label="{{ __('Send') }}" theme="secondary" icon="fab fa-telegram-plane" />
        </form> 
    </x-adminlte-modal>
    </div>  
    <div class="form-group">
        <div class="card p-4">
            @foreach($results as $key => $value)
                @isset($value['channel_post'])
                    
                <p> {{ $value['channel_post']['sender_chat']['username'] }}: {{ $value['channel_post']['text'] }} </p> 
                @endisset
                
            @endforeach
        </div>
        <div class="card p-4">
            <label for="description"> {{ __('Text') }} </label>
            <textarea id="summernote" class="summernote form-control" rows="8" name="description">  </textarea>
        </div>
        <input type="submit" value=" {{ __('Send') }}" class="btn btn-success float-right">
    </div>
@endsection

@section('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote(
            {
                tabsize: 2,
                height: 140,
                lang: 'es-ES' 
            }
        );
    });
    var edit = function() {
        $('#summernote').summernote({focus: true});
        };

    var save = function() {
        var markup = $('.summernote').summernote('code');
        $('#summernote').summernote('destroy');
        };

</script>
@endsection
 