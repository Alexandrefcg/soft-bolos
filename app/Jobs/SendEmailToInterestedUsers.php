<?php

namespace App\Jobs;

use App\Models\Cake;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\CakeAvailableMail;

class SendEmailToInterestedUsers implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected Cake $cake;

    public function __construct(Cake $cake)
    {
        $this->cake = $cake;
    }

    public function handle(): void
    {
        $emails = $this->cake->interestedEmails->pluck('email')->toArray();

        foreach ($emails as $email) {
            Mail::to($email)->send(new CakeAvailableMail($this->cake));
        }
    }
}
