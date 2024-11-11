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
                    <a class="btn btn-app bg-secondary">
                        <i class="fas fa-solid fa-mobile"></i> {{ __('New') }}
                    </a>
                    <a class="btn btn-app bg-danger">
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
<div class="card">
    <div class="card-body">
        <form action="{{ route('event.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <x-adminlte-input name="title" id="title" label="{{ __('Title') }}" label-class="text-lightblue">
                </x-adminlte-input>
            </div>
            <div class="form-group">
                <x-adminlte-input name="date" id="date" label="{{ __('Date') }}" placeholder="aaaa-mm-dd"
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
                foreach ($rooms as $room) {
                $options[$room->id] = $room->name;
                }
                @endphp
                <x-adminlte-select id="room_id" name="room_id" label="{{ __('Rooms') }}" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-lg fa-certificate text-lightblue"></i>
                        </div>
                    </x-slot>

                    <x-adminlte-options :options="$options" empty-option="{{ __('Select an option...') }}" />
                </x-adminlte-select>
            </div>

            <div class="form-group">
                <div class="card p-4">
                    <label for="summernote"> {{ __('staircase') }} </label>
                    <textarea id="summernote" class="form-control" rows="4"
                        name="description"> {{ old('description') }} </textarea>
                </div>

                @include('event.room-render')
            </div>
            <div class="form-group">
                <a href="{{ route('event.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                <input type="submit" value="{{ __('Create') }}" class="btn btn-success float-right">
            </div>
        </form>
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="/assets/css/seats.css">
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
       
        event.preventDefault;
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
    // https://codepen.io/hectorfeliz/pen/QbvXLo
    $(".seatNumber").click(
        function() {
            if (!$(this).hasClass("seatUnavailable")) {
                // If selected, unselect it
                if ($(this).hasClass("seatSelected")) {
                    var thisId = $(this).attr('id');
                    var price = $('#seatsList .' + thisId).val();
                    $(this).removeClass("seatSelected");
                    $('#seatsList .' + thisId).remove();
                    // Calling functions to update checkout total and seat counter.
                    removeFromCheckout(price);
                    refreshCounter();
                } else {
                    // else, select it
                    // getting values from Seat
                    var thisId = $(this).attr('id');
                    var id = thisId.split("_");
                    var price = $(this).attr('value');
                    var seatDetails = "Row: " + id[0] + " Seat:" + id[1] + " Price:CA$:" + price;


                    var freeSeats = parseInt($('.freeSeats').first().text());
                    var selectedSeats = parseInt($(".seatSelected").length);

                    // If you have free seats available the price of this one will be 0.
                    if (selectedSeats < freeSeats) {
                        price = 0;
                    }

                    // Adding this seat to the list
                    var seatDetails = "Row: " + id[0] + " Seat:" + id[1] + " Price:CA$:" + price;
                    $("#seatsList").append('<li value=' + price + ' class=' + thisId + '>' + seatDetails + "  " +
                        "<button id='remove:" + thisId +
                        "'+ class='btn btn-default btn-sm removeSeat' value='" + price +
                        "'><strong>X</strong></button></li>");
                    $(this).addClass("seatSelected");

                    addToCheckout(price);
                    refreshCounter();
                }
            }
        }
    );
    // Clicking any of the dynamically-generated X buttons on the list
    $(document).on('click', ".removeSeat", function() {
        // Getting the Id of the Seat
        var id = $(this).attr('id').split(":");
        var price = $(this).attr('value')
        $('#seatsList .' + id[1]).remove();
        $("#" + id[1] + ".seatNumber").removeClass("seatSelected");
        removeFromCheckout(price);
        refreshCounter();
    });
    // Show tooltip on hover.
    $(".seatNumber").hover(
        function() {
            if (!$(this).hasClass("seatUnavailable")) {
                var id = $(this).attr('id');
                var id = id.split("_");
                var price = $(this).attr('value');
                var tooltip = "Row: " + id[0] + " Seat:" + id[1] + " Price:CA$:" + price;

                $(this).prop('title', tooltip);
            } else {
                $(this).prop('title', "Seat unavailable");
            }
        }
    );
    // Function to refresh seats counter
    function refreshCounter() {
        $(".seatsAmount").text($(".seatSelected").length);
    }
    // Add seat to checkout
    function addToCheckout(thisSeat) {
        var seatPrice = parseInt(thisSeat);
        var num = parseInt($('.txtSubTotal').text());
        num += seatPrice;
        num = num.toString();
        $('.txtSubTotal').text(num);
    }
    // Remove seat from checkout
    function removeFromCheckout(thisSeat) {
        var seatPrice = parseInt(thisSeat);
        var num = parseInt($('.txtSubTotal').text());
        num -= seatPrice;
        num = num.toString();
        $('.txtSubTotal').text(num);
    }

    // Clear seats.
    $("#btnClear").click(
        function() {
            $('.txtSubTotal').text(0);
            $(".seatsAmount").text(0);
            $('.seatSelected').removeClass('seatSelected');
            $('#seatsList li').remove();
        }
    );
</script>






@endsection