@extends('adminlte::page')


@section('content_header')
    <h2>{{ __('Reserve') }}</h2>



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reserve') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                {{ $user->name }}
                                Asientos:
                                @foreach ($user->seats as $as)
                                    <p>{{ $as->position }} {{ $as->reserved_at }}</p>
                                @endforeach
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 d-flex align-items-stretch flex-column">
                                @for ($i = 4; $i < 9; $i++)
                                    <div class="seatRow">
                                        <div class="seatRowNumber">
                                            Row - {{ $i }}
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                        @for ($j = 0; $j < 12-$i; $j++)
                                            <div id="{{ $i }}_{{ $j }}" role="checkbox" data-toggle="tooltip" title="{{ _('Free') }}"
                                                value="{{ $i }}{{ $j }}" aria-checked="false"
                                                focusable="true" tabindex="-1" class=" seatNumber seatUnavailable">
                                                {{ $j }}</div> 
                                        @endfor
                                        <div id="1_8" role="checkbox" value="45" aria-checked="false" data-toggle="tooltip" title="{{ _('Reserved') }}"
                                            focusable="true" tabindex="-1" class=" seatNumber ">8</div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div class="col-6 d-flex align-items-stretch flex-column">
                                @for ($i = 4; $i < 9; $i++)
                                    <div class="seatRow">
                                        <div class="seatRowNumber">
                                            R-{{ $i }}
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                        @for ($j = 0; $j < 12-$i; $j++)
                                            <div id="{{ $i }}_{{ $j }}" role="checkbox" data-toggle="tooltip" title="{{ _('Free') }}"
                                                value="{{ $i }}{{ $j }}" aria-checked="false"
                                                focusable="true" tabindex="-1" class=" seatNumber seatUnavailable">
                                                {{ $j }}</div> 
                                        @endfor
                                        <div id="1_8" role="checkbox" value="45" aria-checked="false" data-toggle="tooltip" title="{{ _('Reserved') }}"
                                            focusable="true" tabindex="-1" class=" seatNumber ">8</div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div class="col-12  d-flex align-items-stretch flex-column">
                                @for ($i = 0; $i < 9; $i++)
                                    <div class="seatRow">
                                        <div class="seatRowNumber">
                                            Row - {{ $i }}
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                        @for ($j = 0; $j < 12-$i; $j++)
                                            <div id="{{ $i }}_{{ $j }}" role="checkbox" data-toggle="tooltip" title="{{ _('Free') }}"
                                                value="{{ $i }}{{ $j }}" aria-checked="false"
                                                focusable="true" tabindex="-1" class=" seatNumber seatUnavailable">
                                                {{ $j }}</div> 
                                        @endfor
                                        <div id="1_8" role="checkbox" value="45" aria-checked="false" data-toggle="tooltip" title="{{ _('Reserved') }}"
                                            focusable="true" tabindex="-1" class=" seatNumber ">8</div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@section('css')
    <link rel="stylesheet" href="/css/seats.css">
@endsection

@section('js')
    <script src="/js/seats.js"></script>
@endsection

<style>
    .seatSelection {
        text-align: center;
        padding: 5px;
        margin: 15px;
    }

    .seatsReceipt {
        text-align: center;
    }

    .seatNumber {
        margin: 2px;
        background-color: #5c86eb;
        color: #FFF;
        border-radius: 5px;
        cursor: default;
        height: 25px;
        width: 25px;
        line-height: 25px;
        text-align: center;
    }

    .seatSelected {
        background-color: lightgreen;
        color: black;
    }

    .seatUnavailable {
        background-color: gray;
    }

    .seatRowNumber {
        clear: none;
        display: inline;
    }

    .hidden {
        display: none;
    }

    .seatsAmount {
        max-width: 2em;
    }
</style>
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
