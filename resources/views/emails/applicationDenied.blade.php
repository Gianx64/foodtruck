@component('mail::message')
 
Your foodtruck {{$foodtruck_name}} (plate: {{$plate}}) has been denied for the {{$event_name}} event.
 
You applied to serve the following food types: {{$foods}}
 
Keep checking for events!
 
@component('mail::button', ['url' => $url])
View Events
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent