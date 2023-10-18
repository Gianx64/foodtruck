@component('mail::message')
 
Your account has been accessed with the IP {{$address}}
 
Wasn't you? Recover your account by clicking the following button:
 
@component('mail::button', ['url' => $url])
Recover Account
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent