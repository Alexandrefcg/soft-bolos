<?php

namespace App\Jobs;

use App\Models\Cake;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\CakeAvailableMail;

class SendEmailToInterestedUsers implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $cake;

    public function __construct(Cake $cake)
    {
        $this->cake = $cake;
    }

    public function handle()
    {
        $emails = $this->cake->interestedEmails->pluck('email')->toArray();

        foreach ($emails as $email) {
            Mail::to($email)->send(new CakeAvailableMail($this->cake));
        }
    }
}
