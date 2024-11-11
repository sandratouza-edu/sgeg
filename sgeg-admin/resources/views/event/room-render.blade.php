<x-adminlte-modal id="modalAssign" title="{{ __('Participants') }}" theme="secondary" icon="fab fa-edit" size='lg' disable-animations>
    <div>
        @php
            $heads2 = [
                __('Name'), 
                __('Role'), 
                __('Degree'), 
            ];

            $config2 = [
                'pageLength' => 10,
                'language' => [
                    'url' => url('/vendor/datatables-plugins/lang/'.app()->getLocale().'.json'),
                ], //https://es.stackoverflow.com/questions/87338/cambiar-idioma-de-datatables
            ];

        @endphp


        @if ($users->isEmpty())
            <p>{{ __('List Empty') }}</p>
        @else
            <x-adminlte-datatable id="tableU" :heads="$heads2" :config="$config2" head-theme="dark" striped hoverable
                with-buttons>

                @forelse($users as $user)
                    <tr>
                        <td> <x-checkbox name="terms" id="{{ $user->id }}"  /> {{ $user->name }}  </td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-secondary text-dark">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if(!is_null($user->degree_id ) && ($user->degree_id > 0) )
                                @if(!is_null($user->degree ))
                                    {{ $user->degree->name }}               
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td> {{ __('List Empty') }}</td>
                    </tr>
                @endforelse
            </x-adminlte-datatable>
        @endif
    </div>
    
    <x-adminlte-button type="button" label="{{ __('Assign') }}" class="bg-green" theme="secondary" data-dismiss="modal" />
</x-adminlte-modal>


<div class="room-render">
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
                                <div id="a{{ $i }}_{{ $j }}" role="checkbox" data-toggle="modal" data-target="#modalAssign" title="{{ _('Free') }}" value="{{ $i }}{{ $j }}" aria-checked="false" focusable="true" tabindex="-1" class="seatNumber">
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
                                <div id="{{ $i }}_{{ $j }}" role="checkbox" data-toggle="modal" data-target="#modalAssign" title="{{ _('Free') }}" value="{{ $i }}{{ $j }}" aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber">
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
                            <div id="{{ $i }}_{{ $j }}" role="checkbox" data-toggle="modal" data-target="#modalAssign" title="{{ _('Free') }}" value="{{ $i }}{{ $j }}" aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber ">
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
                                <div id="a{{ $i }}_{{ $j }}" role="checkbox" data-toggle="modal" data-target="#modalAssign" title="{{ _('Free') }}" value="{{ $i }}{{ $j }}" aria-checked="false" focusable="true" tabindex="-1" class="seatNumber">
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
                                <div id="{{ $i }}_{{ $j }}" role="checkbox" data-toggle="modal" data-target="#modalAssign" title="{{ _('Free') }}" value="{{ $i }}{{ $j }}" aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber">
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

