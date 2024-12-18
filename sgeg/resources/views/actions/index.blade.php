@extends('adminlte::page')


@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ __('Actions') }}</h2>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group float-sm-right">
                        <a class="btn btn-app bg-secondary" href="{{ route('settings') }}">
                            <i class="fas fa-solid fa-reply-all"></i> {{ __('Back') }} 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('plugins.BsCustomFileInput', true)

@section('content')

    <div class="row">
        <div class="col-md-6">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Import') }} - {{ __('Students') }}</h3>
                </div>
                <div class="card-body"> 
                    @component('components.csv-form')
                    @endcomponent
                </div>
                
            </div>
        </div>
            <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Export') }} -  {{ __('Users') }}</h3>
                </div>
                <div class="card-body">
                  
                    @component('components.csv-export')
                    @endcomponent
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
          
        <div class="col-md-12">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Search') }}</h3>
                </div>


                <div class="card-body">

                    @php
                        $heads = [
                            'Name',
                            ['label' => 'Phone', 'width' => 40],
                            'Email',
                            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
                        ];

                        $config = [
                            'order' => [[1, 'asc']],
                            'columns' => [null, null, null, ['orderable' => true]],
                        
                            'language' => [
                                'url' => url('/vendor/datatables-plugins/lang/'.app()->getLocale().'.json'),
                            ], 
                        ];

                    @endphp


                    @if ($users->isEmpty())
                        <p>{{ __('List is empty') }}</p>
                    @else
                        <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" striped hoverable
                            with-buttons>

                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name }} </td>
                                    <td>
                                        <a class="btn btn-xs bg-info">
                                            <i class="fab fa-telegram-plane"></i>
                                        </a>
                                        {{ $user->phone }}
                                    </td>
                                    <td> <a href="{{ route('sendmail') }}"> {{ $user->email }} </a></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('user.edit', $user) }}"
                                            class="btn btn-xs btn-default text-teal mx-1 shadow" title="{{ __('Edit') }}">
                                                <i class="fa fa-lg fa-fw fa-pen"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td> {{ __('List is empty') }}</td>
                                </tr>
                            @endforelse
                        </x-adminlte-datatable>

                        <div class="pagination">
                        </div>
                    @endif

                </div>


                <div class="card-footer">

                    <button type="submit" class="btn btn-default float-right">{{ __('Cancel') }}</button>
                </div>

            </div>

        </div>

    </div>

@endsection
