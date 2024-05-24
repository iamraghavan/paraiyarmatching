<?php

namespace App\Jobs;

use App\Mail\SuccessfulLoginEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSuccessfulLoginEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userEmail;

    /**
     * Create a new job instance.
     *
     * @param string $userEmail
     * @return void
     */
    public function __construct($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Pass $this->userEmail to the constructor of SuccessfulLoginEmail
        Mail::to($this->userEmail)->send(new SuccessfulLoginEmail($this->userEmail));
    }
}