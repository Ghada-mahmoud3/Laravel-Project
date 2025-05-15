<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewJobNotification extends Notification
{
    use Queueable;

    protected $job;

    public function __construct($job)
    {
        $this->job = $job;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new job "' . $this->job->title . '" was submitted by ' . $this->job->employer->name . '.',
            'job_id' => $this->job->id,
        ];
    }
}
