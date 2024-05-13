@component('mail::message')
# Successful Login

Your account was successfully logged in at {{ $login_time }}.

**Browser Information:**
{{ $browser_info }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
