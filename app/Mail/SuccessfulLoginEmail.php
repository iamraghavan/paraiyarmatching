<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuccessfulLoginEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $userEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = User::where('email', $this->userEmail)->firstOrFail();
        return $this->markdown('mails.successful_login')
            ->subject('Successful Login Email')
            ->with([
                'login_time' => now()->toDateTimeString(),
                'browser_info' => request()->header('User-Agent'),
                'user' => $user,
            ]);
    }
}
