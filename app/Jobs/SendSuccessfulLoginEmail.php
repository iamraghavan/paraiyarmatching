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

class SendSuccessfulLoginEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $loginTime;
    protected $browserInfo;

    /**
     * Create a new job instance.
     *
     * @param int $userId
     * @param string $loginTime
     * @param string $browserInfo
     */
    public function __construct($userId, $loginTime, $browserInfo)
    {
        $this->userId = $userId;
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
        // Fetch the user from the database
        $user = User::find($this->userId);

        if ($user) {
            Mail::to($user->email)
                ->send(new SuccessfulLoginNotification($this->loginTime, $this->browserInfo));
        }
    }
}
