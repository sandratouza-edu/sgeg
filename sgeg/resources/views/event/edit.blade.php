@extends('adminlte::page')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Event') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('event.index') }}">
                            <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }}
                        </a>
                        <a class="btn btn-app bg-secondary" href="{{ route('event.create') }}">
                            <i class="fas fa-solid fa-mobile"></i> {{ __('New') }}
                        </a>
                        <a class="btn btn-app bg-danger" href="{{ route('event.index') }}">
                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('event.update', $event->id) }}" method="POST">
                @method('put')
                @csrf
                <div class="form-group">
                    <x-adminlte-input name="title" id="title" label="{{ __('Title') }}" label-class="text-lightblue" value="{{ $event->title }}">
                    </x-adminlte-input>
                </div>
                <div class="form-group">
                    <x-adminlte-input name="date" id="date" label="{{ __('Date') }}" placeholder="aaaa-mm-dd" value="{{ $event->date }}"
                        label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-calendar text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="form-group">  
                    @php
                        $options = [];
                        foreach ($rooms as $ro) {
                            $options[$ro->id] = $ro->name;
                        }
                        $selected = $event->room_id
                        
                    @endphp
                    @if (!empty($event->room_id)) 
                         
                    @endif 
                    <x-adminlte-select id="room_id" name="room_id" label="{{ __('Rooms') }}" label-class="text-lightblue" disabled>
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-lg fa-certificate text-lightblue"></i>
                            </div>
                        </x-slot>
                        
                        <x-adminlte-options :options="$options" :selected="$selected" empty-option="{{ __('Select an option...') }}" />
                    </x-adminlte-select>
                </div>
                
                <div class="form-group">
                    <div class="card p-4">
                        <label for="summernote"> {{ __('staircase') }} </label>
                        <textarea id="summernote" class="summernote form-control" rows="4" name="description"> {{ $event->description }} </textarea>
                    </div>
                </div>
                <br>
                
                <div class="form-group">
                    <a href="{{ route('event.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    <input type="button" value="{{ __('Update') }}" class="btn btn-success float-right">
                </div>
            </form>
        </div>
        @if ($event->room)
            @include('event.room-render', ['room' => $event->room])
        @endif
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="/assets/css/seats.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote(
            {
                tabsize: 2,
                height: 340,
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

<script>
    $('#modalAssign').on('show.bs.modal', function (event) {
        $('.students.hidden').hide();
        var button = $(event.relatedTarget); // Button that triggered the modal
            var number = button.data('number');
            var modal = $(this);
            modal.find('#number_id').val(number);            
        console.log(number);
            event.preventDefault;
    });
    document.getElementById('assignSeat').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);
        fetch('{{ route('reserve') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Error al asignar el asiento');
                });
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message);
            form.reset(); // Opcional: reinicia el formulario
            $('#modalAssign').modal('hide'); // Cierra el modal
           // location.reload(); // Recarga la página para actualizar la lista (opcional)
        })
        .catch(error => {
            console.log(error.message);
        });
    });

    $('#roles').on('change', function() {
        if (this.value == 2) {
            $('.students.hidden').show();
        } else {
            $('.students.hidden').hide();
        }
    });
    $('#modalAssign').on('hidden.bs.modal', function (e) {
        let dg = '';
        if ($('.form-sendMail #roles option:selected' ).val() == 2) {
            dg = "-"+$('.form-sendMail #degree option:selected' ).text();
        }
        $('.form-sendMail #group').attr('value', $('.form-sendMail #roles option:selected' ).text() + dg );
        
   
    });
</script>
<script>
    // Clicking any seat
    $(".seatNumber").click(
        function() {
            if (!$(this).hasClass("seatUnavailable")) {
                // If selected, unselect it
                if ($(this).hasClass("seatSelected")) {
                    var thisId = $(this).attr('id');
                    $(this).removeClass("seatSelected");
                    $('#seatsList .' + thisId).remove();
                    // Calling functions to update checkout total and seat counter.
                    refreshCounter();
                } else {
                    // else, select it
                    // getting values from Seat
                    var thisId = $(this).attr('id');
                    var id = thisId.split("_");
                    var seatDetails = " " + id[0] + " {{ __('Seat') }}: " + id[1] + "  " ;


                    var freeSeats = parseInt($('.freeSeats').first().text());
                    var selectedSeats = parseInt($(".seatSelected").length);
 

                    // Adding this seat to the list
                    var seatDetails = " -" + id[0] + " {{ __('Seat') }}: " + id[1] ;
                    $("#seatsList").append('<li value=' + thisId + ' class=' + thisId + '>' + seatDetails + "  " + " </li>");
                    $(this).addClass("seatSelected");

                    refreshCounter();
                }
            }
        }
    );
    // Clicking any of the dynamically-generated X buttons on the list
    $(document).on('click', ".removeSeat", function() {
        // Getting the Id of the Seat
        var id = $(this).attr('id').split(":");
        $('#seatsList .' + id[1]).remove();
        $("#" + id[1] + ".seatNumber").removeClass("seatSelected");
        refreshCounter();
    });
    // Show tooltip on hover.
    $(".seatNumber").hover(
        function() {
            if (!$(this).hasClass("seatUnavailable")) {
                var id = $(this).attr('id');
                var id = id.split("_");
                var tooltip = "Row: " + id[0] + " Seat:" + id[1] ;

                $(this).prop('title', tooltip);
            } else {
                $(this).prop('title', "Seat unavailable");
            }
        }
    );
    // Function to refresh seats counter
    function refreshCounter() {
    }
     
    // Clear seats.
    $("#btnClear").click(
        function() {
            $('.seatSelected').removeClass('seatSelected');
            $('#seatsList li').remove();
        }
    );
</script>

@endsection