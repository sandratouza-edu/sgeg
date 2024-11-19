@extends('adminlte::page')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">{{ __('Profile') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6  d-flex align-items-center flex-column">
                            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.update-profile-information-form')

                            <x-section-border />
                            @endif
                        </div>
                        <div class="col-6  d-flex align-items-center flex-column">

                            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            <div class="card card-info">
                                @livewire('profile.update-password-form')
                            </div>
                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection