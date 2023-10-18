@component('mail::message')
 
Your foodtruck {{$foodtruck_name}} (plate: {{$plate}}) has been approved for the {{$event_name}} event!
 
You applied to serve the following food types: {{$foods}}
 
The event date is {{$event_date}}, mark your calendar!
 
@component('mail::button', ['url' => $url])
View Event
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent