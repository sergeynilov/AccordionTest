@component('mail::message')

Dear manager!

{{ $authorUser->name }} added claim with content :

title : {{ $title }}

client_name : {{ $client_name }}

client_email : {{ $client_email }}

text : {{ $text }}



Thanks,<br>
{{ config('app.name') }}
@endcomponent

