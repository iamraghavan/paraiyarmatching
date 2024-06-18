@component('mail::message')
# Successful Login Notification

Dear ,

We are pleased to inform you that your account has been successfully logged in at {{ $login_time }}. This notification is to confirm that your login attempt has been successful and that you are now logged in to your account.

**Browser Information:**
{{ $browser_info }}

### Security Tips

| Tip | Description |
| --- | --- |
| Keep your password confidential | Always keep your password confidential and do not share it with anyone. |
| Use a strong and unique password | Use a strong and unique password for your account. |
| Regularly update your browser and operating system | Regularly update your browser and operating system to ensure you have the latest security patches. |
| Be cautious when clicking on links or downloading attachments | Be cautious when clicking on links or downloading attachments from unknown sources. |

If you have any questions or concerns about your account or our security measures, please do not hesitate to contact our support team at [support@paraiyarmatching.com](mailto:support@paraiyarmatching.com).

### Thank You

Thank you for choosing Paraiyar Matching, and we hope you have a great experience on our platform.

Best regards,
{{ config('app.name') }}

@endcomponent
