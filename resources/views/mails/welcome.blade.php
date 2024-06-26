@component('mail::message')
# Welcome to Our Platform!

Dear {{ $user->name }},

We are delighted to welcome you to our platform. Thank you for joining us!


Best regards,<br>
Paraiyar Matching

@component('mail::button', ['url' => ''])
   Login to View Dashboard
@endcomponent
@endcomponent
