@component('mail::message')

Dear User,

We are pleased to inform you that your account has been successfully logged in at {{ $loginTime }}. This notification is to confirm that your login attempt has been successful and that you are now logged in to your account.

**Browser Information:**
{{ $browserInfo }}

If you have any questions or concerns about your account or our security measures, please do not hesitate to contact our support team at [support@paraiyarmatching.com](mailto:support@paraiyarmatching.com).

### Thank You

Thank you for choosing Paraiyar Matching, and we hope you have a great experience on our platform.

Best regards,
<br>
{{ config('app.name') }}

@endcomponent
