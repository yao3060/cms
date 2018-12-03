@component('mail::message')
# Welcome back {{ $user->name }}

The body of your message.
Thanks for signing up. ** Wereally appreciate** it.

@component('mail::panel')
The email address you signed up this is: {{ $user->email }}
@endcomponent

@component('mail::button', ['url' => 'http://127.0.0.1/home'])
View my Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
