@component('mail::message')
# Welcome to Our Platform!

Dear {{ $userName }},

We are delighted to welcome you to our platform. Your Aadhaar number ends with <b> **** **** {{ $aadhaarLastFourDigits }}</b>. Thank you for joining us!

<br>

If you have any questions or concerns about your account or our security measures, please do not hesitate to contact our support team at [support@paraiyarmatching.com](mailto:support@paraiyarmatching.com).

### Thank You

Thank you for choosing Paraiyar Matching, and we hope you have a great experience on our platform.

Best regards,
<br>
{{ config('app.name') }}

@endcomponent
