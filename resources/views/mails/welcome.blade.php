@component('mail::message')
# Welcome to Our Platform!

Dear {{ $user->name }},

We are delighted to welcome you to our platform. Thank you for joining us!

Best regards,<br>
Raghavan Jeeva

{{-- If you need a custom button, uncomment the code below and customize it --}}
{{-- @component('mail::button', ['url' => ''])
    View Dashboard
@endcomponent --}}
@endcomponent
