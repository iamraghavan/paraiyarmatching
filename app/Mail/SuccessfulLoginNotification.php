<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuccessfulLoginNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $loginTime;
    public $browserInfo;

    /**
     * Create a new message instance.
     *
     * @param string $loginTime
     * @param string $browserInfo
     */
    public function __construct($loginTime, $browserInfo)
    {
        $this->loginTime = $loginTime;
        $this->browserInfo = $browserInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.successful_login')
            ->subject('Login Notification from Paraiyar Matching');
    }
}
