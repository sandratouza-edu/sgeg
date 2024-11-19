<x-adminlte-modal id="modalAssign" title="{{ __('Participants') }}" theme="secondary" icon="fab fa-edit" size='lg' disable-animations>
    <form action="{{ route('reserve') }}" id="assignSeat" method="POST">
        @method('post')
        @csrf
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
                        <td> <x-checkbox id="{{ $user->name }}" value="{{ $user->id }}" name="user_id" /> {{ $user->name }}  </td>
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
    <x-adminlte-input type="hidden" name="number_id" id="number_id" value="2"> </x-adminlte-input>
    <x-adminlte-input type="hidden" name="room_id" value="{{ $event->room_id }}"> </x-adminlte-input>
    <x-adminlte-button type="submit" label="{{ __('Assign') }}" class="bg-green" theme="secondary" />
    
</form>
</x-adminlte-modal>

<div class="room-render">
    
    <div class="card-header">
        <h2> {{ $room->name }}  </h2>
    </div>
    <div class="card-body">
        @php($seat = 0)
        <p>
            @isset($room->structure['numareas'] )
            <label for="">Areas: {{ $room->structure['numareas'] }} </label>
                @foreach ($room->structure['areas'] as $area)
                <div class="row">
                    @isset($area['numsections'] )
                        @foreach ($area['sections'] as $index=>$section)
                            @if ($index < $area['numsections']/2)
                                <div class="col-{{ 12/$area['numsections'] }} d-flex align-items-center flex-column">
                                    <label for="">Seccion {{ $index+1 }} - Derecha </label>                                                                          
                                    @for ($i = 1; $i <= $section['rows'] ; $i++) 
                                        <div class="seatRow"> 
                                            <div class="d-flex align-items-center justify-content-center">
                                                <label for="">Fila {{ $section['rows']-$i+1 }} </label>
                                                @for ($j = 1; $j <= $section['cols']-$i; $j++) 
                                                    <div id="Fila {{ $section['rows']-$i+1 }} _{{ $j }}"  data-number="{{ $seat++ }}" role="checkbox" data-toggle="modal" data-target="#modalAssign" title="{{ _('Free') }}" aria-checked="false" focusable="true" tabindex="-1" 
                                                    class="seatNumber @if(in_array($seat, $positions)) seatSelected @endif">
                                                    {{ $j }}
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @else
                                <div class="col-{{ 12/$area['numsections'] }} d-flex align-items-center flex-column">
                                    <label for="">Seccion {{ $index+1 }} - Izquierda</label>                                                                            
                                    @for ($i = 1; $i <= $section['rows'] ; $i++) 
                                        <div class="seatRow">
                                            <div class="d-flex align-items-center justify-content-center">
                                               
                                                @for ($j = 1; $j <= $section['cols']-$i; $j++) 
                                                    <div id="Fila{{ $section['rows']-$i+1 }}_{{ $j }}" data-number="{{ $seat++ }}" role="checkbox" data-toggle="modal" data-target="#modalAssign" title="{{ _('Free') }}"  aria-checked="false" focusable="true" tabindex="-1" 
                                                    class=" seatNumber @if(in_array($seat, $positions)) seatSelected @endif">
                                                    {{ ($j) }} 
                                                    </div>
                                                @endfor
                                                <label for="">Fila {{ $section['rows']-$i+1 }} </label>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @endif
                        @endforeach
                    @endisset
                </div>

                @endforeach
            @endisset
        </p>
    </div>

    <div class="row">
        <div class="col-12  d-flex align-items-center flex-column">
            <div class="seatRow">
                <p> </p>
                <p> </p>
                <div class="seatRowNumber">
                   <strong>Mesa </strong>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    @for ($j = 0; $j < 12; $j++) 
                        <div id="t_{{ $j }}" role="checkbox" data-toggle="tooltip" title="{{ _('Free') }}" value="{{ $j }}" aria-checked="false" focusable="true" tabindex="-1" class=" seatNumber ">
                        {{ $j+1 }}
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div>
            @isset ($user)
                <div class="card">
                    <div class="card-header">
                        <h2> Asientos: </h2>
                    </div>
                    <div class="card-body">
                        @foreach ($user->seats as $as)
                            <p>{{ $as->position }} {{ $as->reserved_at }}</p>
                        @endforeach
                        <hr>
                    </div>
                </div>
            @endisset
            <div class="seatsReceipt">
                <ul id="seatsList" class="nav nav-pills flex-column"></ul>
                <ul class="nav nav-pills flex-column">
                     
                </ul>

            </div> 
        </div>
    </div>

</div>

