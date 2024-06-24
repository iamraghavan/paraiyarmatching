<?php

namespace App\Jobs;

use App\Mail\SuccessfulLoginNotification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendSuccessfulLoginEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $loginTime;
    protected $browserInfo;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param string $loginTime
     * @param string $browserInfo
     */
    public function __construct(User $user, $loginTime, $browserInfo)
    {
        $this->user = $user;
        $this->loginTime = $loginTime;
        $this->browserInfo = $browserInfo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::info("Attempting to send login email to: " . $this->user->email);
            Mail::to($this->user->email)
                ->send(new SuccessfulLoginNotification($this->loginTime, $this->browserInfo));
            Log::info("Login email sent to: " . $this->user->email);
        } catch (\Exception $e) {
            Log::error("Failed to send login email: " . $e->getMessage());
            throw $e;
        }
    }
}
