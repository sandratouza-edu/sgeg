@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Send') }} {{ strtolower(__('Email')) }}</h2>
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')    


<form action="{{ route('multi-sendMail')}}" id="assign" method="POST" class="form-sendMail">
    @csrf
   
        <div class="form-group">
            <label for="name"> {{ __('Subject')}} </label>
            <input type="text" id="title" class="form-control" name="subject" value="">
        </div>
        <div class="card">
            <div class="card-header">  <label> {{ __('Recipients')}}  </label> </div>
            <div class="card-body">
            <div class=" container-fluid">   
                <div class="row">
                    <div class="col-md-6">                
                        <div class="form-group">
                            <label for="emails"> <i class="fas fa-at"></i> {{ __('Emails') }} </label>
                            <input type="text" id="emails" class="form-control" name="emails" value="">
                            <span>{{ __('Comma separated') }}</span>
                        </div>

                        @if (!empty($selected)) 
                            <div class="form-group">
                                <label for="recipient"> <i class="fas fa-user"></i> {{ __('Recipients') }} </label>
                                <input type="hidden"  class="form-control" name="recipients" value="{{ $recipients }}" readonly>
                                <input type="text"  class="form-control" name="selected" value="{{ $selected }}" readonly>
                                <span>{{ __('Selected from users list') }}</span>
                            </div>
                        @endif
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">  
                            <label for="group"> <i class="fas fa-user"></i> {{ __('Send') }} {{ strtolower(__('Email')) }} {{ strtolower(__('Lists')) }}: -  {{ __('Roles') }}, {{ __('Degrees') }} </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalAssign" >  {{ __('Search') }}</button>
                                </div>
                                <!-- /btn-group -->
                                <input type="text" id="group" class="form-control" name="group" value="">
                              </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div></div>

        <div class="form-group">
        @php
            $options3 = [];
            foreach ($invitations as $invite) {
                $options3[$invite->id] = $invite->name; 
            }
        @endphp
            <x-adminlte-select id="invitation" name="invitation" label="{{ __('Invitation') }} " label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-blue">
                        <i class="fas fa-lg fa-certificate"></i>
                    </div>
                </x-slot>
                <x-adminlte-options :options="$options3" empty-option="{{ __('Select an option...') }}" />
            </x-adminlte-select>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="description"> {{ __('Text') }} </label>
                    <textarea id="summernote" class="summernote form-control" rows="8" name="description">  </textarea>
                </div>

                <div class="form-group">
                    <input type="submit" value=" {{ __('Send') }}" class="btn btn-success float-right">
                </div>
                <div class="form-group">
                </div>
            </div>
        </div>
        <x-adminlte-modal id="modalAssign" title="{{ __('Recipients') }}" theme="secondary" icon="fab fa-edit" size='lg' disable-animations>
            @php
                $options = [];
                foreach ($degrees as $degree) {
                    if ($degree->active == 1) {
                        $options[$degree->id] = $degree->name; 
                    }
                }
                $options2 = [];
                foreach ($roles as $role) {
                        $options2[$role->name] = $role->name; 
                }
            @endphp
        
            <div class="form-group">
                <x-adminlte-select id="roles" name="roles" label="roles" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-red">
                            <i class="fas fa-lg fa-certificate"></i>
                        </div>
                    </x-slot>
                    <x-adminlte-options :options="$options2" empty-option="{{ __('Select an option...') }}" />
                </x-adminlte-select>
            </div>
            <div class="students hidden">
                <x-adminlte-select id="degree" name="degree" label="{{ __('Degree') }}" label-class="text-lightblue">
                    <x-slot name="prependSlot"> 
                        <div class="input-group-text">
                            <i class="fas fa-lg fa-graduation-cap text-lightblue"></i>
                        </div>
                    </x-slot>                
                    <x-adminlte-options :options="$options" empty-option="{{ __('Select an option...') }}" />
                </x-adminlte-select>
            </div>
            
            <x-adminlte-button type="button" label="{{ __('Save') }}" class="bg-green" theme="secondary" data-dismiss="modal" />
        </x-adminlte-modal>
</form>

@endsection

@section('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
<script>
    $('#modalAssign').on('show.bs.modal', function (event) {
        $('.students.hidden').hide();
       
        event.preventDefault;
    });
    $('#roles').on('change', function() {
        if (this.value == 'student') {
            $('.students.hidden').show();
        } else {
            $('.students.hidden').hide();
        }
    });
    $('#modalAssign').on('hidden.bs.modal', function (e) {
        let dg = '';
        if ($('.form-sendMail #roles option:selected' ).val() == 'student') {
            dg = "-" + $('.form-sendMail #degree option:selected' ).text();
        }
        $('.form-sendMail #group').attr('value', $('.form-sendMail #roles option:selected' ).text() + dg );
        
   
    });
</script>

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
 