@component('mail::message')
# One Step away to be a member. 

Please click the button below to verify your email address.

@component('mail::button', ['url' => url(config('app.url').'/verify?token='.$tokenVar->token.'&userId='.$userVar->id), 'color' => 'blue' ])
Verify My Email Address
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
