<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ApplicationStatusNotification extends Notification
{
    use Queueable;

    protected $job;
    protected $status;

    public function __construct($job, $status)
    {
        $this->job = $job;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your application for "' . $this->job->title . '" has been ' . $this->status . '.',
            'job_id' => $this->job->id,
        ];
    }
}
