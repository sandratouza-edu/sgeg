@component('mail::message')
    {{ env('APP_NAME') }}
    {{ __('You have been invited to join the :team team!', ['team' => $invitation->team->name]) }}

    {{ __('You may accept this invitation by clicking the button below:') }}
     
   <!-- Acceda a la plataforma
    Compruebe los datos personales si son correctos
    Use link to telegram channel para estar actualizado
    Confirme sus invitados -->

    @component('mail::button', ['url' => $acceptUrl])
        {{ __('Accept Invitation') }}
    @endcomponent

        {{ __('If you did not expect to receive an invitation to this team, you may discard this email.') }}
@endcomponent
