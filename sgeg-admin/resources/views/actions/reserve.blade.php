@extends('adminlte::page')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Event') }}</h2>
                </div>
                <div class="col-sm-6">
                     
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
            <div class="card">
                <div class="card-header">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name"> {{ __('Title') }} </label>
                            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                       
                        <div class="form-group">
                            <div class="card p-4">
                                <label for="description"> {{ __('Staircase') }} </label>
                                <textarea id="summernote" class="summernote form-control" rows="4" name="description"> {{ old('description') }} </textarea>               
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('attachment.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                            {{ Form::hidden('user_id', Auth::user()->id) }}
                            {{ Form::hidden('type', "doc") }}
                            <input type="submit" value="{{ __('Create') }}" class="btn btn-success float-right">
                        </div>
                    </form>
                    @isset ($user)
                    <div>
                        {{ $user->name }}
                        Asientos:
                        @foreach ($user->seats as $as)
                        <p>{{ $as->position }} {{ $as->reserved_at }}</p>
                        @endforeach
                        <hr>
                    </div>
                    @endisset
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-6 d-flex align-items-stretch flex-column">
                        <div class="row">
                            <div class="col-6 d-flex align-items-stretch flex-column">
                                @for ($i = 0; $i < 4; $i++) 
                                    <div class="seatRow">
                                        <div class="seatRowNumber">
                                            Row-{{ 4-$i }}
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            @for ($j = 0; $j <= 13-1-$i; $j++) 
                                                <div id="a{{ $i }}_{{ $j }}" role="checkbox" data-toggle="tooltip" title="{{ _('Free') }}" value="{{ $i }}{{ $j }}" aria-checked="false" focusable="true" tabindex="-1" class="seatNumber">
                                                    {{ $j+1 }}
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div class="col-6 d-flex align-items-stretch flex-column">
                                @for ($i = 0; $i < 4; $i++) 
                                    <div class="seatRow">
                                        <div class="seatRowNumber">
                                            Row-{{ 4-$i }}
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            @for ($j = 0; $j <= 13-1-$i; $j++) 
                                                <div id="{{ $i }}_{{ $j }}" role="checkbox" data-toggle="tooltip" title="{{ _('Free') }}" value="{{ $i }}{{ $j }}" aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber">
                                                {{ $j+1 }}
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex align-items-stretch flex-column">
                                @for ($i = 0; $i < 7; $i++) 
                                <div class="seatRow">
                                    <div class="seatRowNumber">
                                        Row-{{ 7-$i }}
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        @for ($j = 0; $j <= 22-2-$i; $j++) 
                                            <div id="{{ $i }}_{{ $j }}" role="checkbox" data-toggle="tooltip" title="{{ _('Free') }}" value="{{ $i }}{{ $j }}" aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber ">
                                            {{ $j+1 }}
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                        </div>
                        <div class="col-6 d-flex align-items-stretch flex-column">
                        <div class="row">
                            <div class="col-6 d-flex align-items-stretch flex-column">
                                @for ($i = 0; $i < 4; $i++) 
                                    <div class="seatRow">
                                        <div class="seatRowNumber">
                                            Row-{{ 4-$i }}
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            @for ($j = 0; $j <= 13-1-$i; $j++) 
                                                <div id="a{{ $i }}_{{ $j }}" role="checkbox" data-toggle="tooltip" title="{{ _('Free') }}" value="{{ $i }}{{ $j }}" aria-checked="false" focusable="true" tabindex="-1" class="seatNumber">
                                                    {{ $j+1 }}
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div class="col-6 d-flex align-items-stretch flex-column">
                                @for ($i = 0; $i < 4; $i++) 
                                    <div class="seatRow">
                                        <div class="seatRowNumber">
                                            Row-{{ 4-$i }}
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            @for ($j = 0; $j <= 13-1-$i; $j++) 
                                                <div id="{{ $i }}_{{ $j }}" role="checkbox" data-toggle="tooltip" title="{{ _('Free') }}" value="{{ $i }}{{ $j }}" aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber">
                                                {{ $j+1 }}
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12  d-flex align-items-stretch flex-column">
                                @for ($i = 0; $i < 7; $i++) 
                                <div class="seatRow">
                                    <div class="seatRowNumber">
                                        Row-{{ 7-$i }}
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        @for ($j = 0; $j <= 22-2-$i; $j++) 
                                            <div id="{{ $i }}_{{ $j }}" role="checkbox" data-toggle="tooltip" title="{{ _('Free') }}" value="{{ $i }}{{ $j }}" aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber ">
                                            {{ $j+1 }}
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                @endfor
                            </div>
                            
                        </div>
                        </div>                        
                   
                        <div class="col-12  d-flex align-items-stretch flex-column">
                            <div class="seatRow">
                                <p> </p>
                                <p> </p>
                                <div class="seatRowNumber">
                                   <strong>Mesa </strong>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    @for ($j = 0; $j < 8; $j++) 
                                        <div id="t_{{ $j }}" role="checkbox" data-toggle="tooltip" title="{{ _('Free') }}" value="{{ $j }}" aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber ">
                                        {{ $j+1 }}
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    
                </div>

                <div class="card-footer">
                    <div><p> </p>
                        <div class="seatsReceipt col-lg-2">
                            <p> </p><p> </p>
                            <p>
                                <strong>Selected Seats: <span class="seatsAmount"> 0 </span></strong>
                                <button id="btnClear" class="btn">Clear</button>
                            </p>
                            <ul id="seatsList" class="nav nav-stacked"></ul>
                        </div>

                        <div class="checkout col-lg-offset-6">
                            <span>Subtotal: CA$</span>
                            <span class="txtSubTotal">0.00</span><br />
                            <button id="btnCheckout" name="btnCheckout" class="btn btn-primary"> Check out </button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
 

@endsection

@section('css')
<link rel="stylesheet" href="/assets/css/seats.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

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