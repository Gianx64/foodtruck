@component('mail::message')
 
The document "{{$document_name}}" for your foodtruck {{$foodtruck_name}} (plate: {{$plate}}) has been approved!
 
You may be able to apply for new events!
 
@component('mail::button', ['url' => $url])
View Events
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent