@component('mail::message')
# Logout Notification

Hello {{ $userName }},

You have been successfully logged out from our application.

If this logout was not initiated by you, please contact our support team immediately.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
