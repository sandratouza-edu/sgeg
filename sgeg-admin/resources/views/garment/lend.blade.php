@extends('adminlte::page')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Requests') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('garment.index') }}">
                            <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }}
                        </a>
                        <a class="btn btn-app bg-secondary bg-info" href="{{ route('garment.borrow') }}">
                            <i class="fas fa-solid fa-graduation-cap"></i> {{ __('Request') }} 
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
    @php
        $heads = [
            __('Garment'),
            ['label' => __('Requests'), 'width' => 2],  
            __('Owner'),    
            ['label' => __('Properties'), 'width' => 10],
            __('Requested by'),
            __('Date') ,  __('Description') , __('Status') ,
            ['label' => __('Actions'), 'no-export' => true, 'width' => 7],
            ['label' => __('Delete'), 'width' => 2],
        ];
        $config = [
            'language' => [
                'url' => url('/vendor/datatables-plugins/lang/'.app()->getLocale().'.json'),
            ], 
        ];
    @endphp
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" striped hoverable with-buttons>
        @forelse($garments as $garment)
            @if (!empty($garment->users[0]))
            <tr style="border-top:2px solid #000;">
                <td rowspan="{{ count($garment->users) }}">
                    {{ $garment->name }}
                </td>
                <td rowspan="{{ count($garment->users) }}">
                    {{ count($garment->users) }}
                </td>
                <td rowspan="{{ count($garment->users) }}"> 
                    {{ $garment->user->name }}  
                </td>
                <td rowspan="{{ count($garment->users) }}">                    
                    {{ __('Color') }}: <i class="fas fa-square" style="color:  {{ $garment->color }}"></i> 
                    - {{ __('Waist') }}: {{ $garment->waist }}  {{ __('Height') }}: {{ $garment->height }}  {{ __('Width') }}: {{ $garment->width }} 
                     @if ($garment->with_cap) {{ __('Cap Size') }}: {{ $garment->size_cap }} @endif  
                </td>
                
                @foreach ($garment->users as $key => $usr) 
                    @if ($key > 0 ) </tr><tr> @endif 
                    <td> {{ $usr->name }} </td> 
                    <td> {{ $usr->requested->reserved_at }}</td> <td> {{ $usr->requested->description }} </td> 
                    <td> 
                        {{ __($usr->requested->status) }}                       
                    </td>
                    <td> 
                        <div class="btn-group">
                            <form action="{{ route('garment.status', $garment) }}" method="POST" class="form-status">
                                @csrf
                                <input type="hidden" name="status" value="accepted">
                                <input type="hidden" name="reserved_at" value="{{  $usr->requested->reserved_at }}">
                                <input type="hidden" name="user" value="{{  $usr->id }}">
                                <button type="submit" class="btn btn-xs btn-default text-green mx-1 shadow" title=" {{__('Accept') }}">
                                    <i class="fa fa-lg fa-fw fa-check-circle"></i>
                                </button>
                            </form>
                            <form action="{{ route('garment.status', $garment) }}" method="POST" class="form-status">
                                @csrf
                                <input type="hidden" name="status" value="rejected">
                                <input type="hidden" name="reserved_at" value="{{  $usr->requested->reserved_at }}">
                                <input type="hidden" name="user" value="{{  $usr->id }}">
                                <button type="submit" class="btn btn-xs btn-default text-red mx-1 shadow" title="{{ __('Reject') }}">
                                    <i class="fa fa-lg fa-fw fa-ban"></i>
                                </button>
                            </form>
                            </div>
                        </td>
                        <td> 
                            <form action="{{ route('garment.requestDelete', $garment) }}" method="POST" class="form-delete">
                                @csrf
                                <input type="hidden" name="reserved_at" value="{{  $usr->requested->reserved_at }}">
                                <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                    title="{{ __('Delete') }}">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>
                            </form>
                        
                    </td> 
                @endforeach
            </tr>
            @endif
        @empty
            <tr>
                <td colspan="5"> {{ __('List is empty') }}</td>
            </tr>
        @endforelse
    </x-adminlte-datatable>

@endsection


@section('js')
<script src="/vendor/sweetalert/sweetalert2@11.js"></script>
    @if (session('message'))
        <script>
            $(document).ready(function() {
                let message = "{{ session('message') }}";
                Swal.fire({
                    title: "{{ __('Action') }}",
                    text: message,
                    icon: "success",
                })
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.form-delete').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: "{{ __('Are you sure you want to delete?') }}",
                    text: "",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "{{ __('Cancel') }}",
                    confirmButtonText: "{{ __('Delete') }}"
                }).then((result) => {
                    //if (result.isConfirmed) {
                    if (result.value) {
                        this.submit();
                    }
                });
            })

        })
    </script>
@endsection
