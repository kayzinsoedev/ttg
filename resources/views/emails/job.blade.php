@component('mail::message')

Your map at {{$address}} is empty. Please go and check to refill !
<br/>

This is an auto-generated e-mail, please do not respond.<br/>
{{ config('app.name') }}
@endcomponent
