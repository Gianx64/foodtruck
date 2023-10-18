@component('mail::message')
 
You successfully applied for the event {{$event_name}}
 
with your foodtruck {{$foodtruck_name}} (plate: {{$plate}})
 
offering the following types of food: {{$foods}}.
 
Keep checking your email for any updates!
 
@component('mail::button', ['url' => $url])
View Event
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent