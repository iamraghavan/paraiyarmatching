<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $aadhaarLastFourDigits;

    /**
     * Create a new message instance.
     *
     * @param  string  $userName
     * @param  string  $aadhaarLastFourDigits
     * @return void
     */
    public function __construct($userName, $aadhaarLastFourDigits)
    {
        $this->userName = $userName;
        $this->aadhaarLastFourDigits = $aadhaarLastFourDigits;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.welcome')
            ->subject('Welcome to Our Platform! - Notification - Paraiyar Matching - Matchfinder is a Matchmaking portal for Brides and Grooms')
            ->with([
                'userName' => $this->userName,
                'aadhaarLastFourDigits' => $this->aadhaarLastFourDigits,
            ]);
    }
}
