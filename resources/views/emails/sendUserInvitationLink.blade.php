@component('mail::message')
# Greetings!

You are invited by Schleier IT to be a member of their team. Please click the link below.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/api/user/register-form' ])
Accept Invitation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
