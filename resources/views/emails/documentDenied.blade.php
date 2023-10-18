@component('mail::message')
 
The document "{{$document_name}}" for your foodtruck {{$foodtruck_name}} (plate: {{$plate}}) has been denied.
 
Please try again.
 
@component('mail::button', ['url' => $url])
View Profile
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent