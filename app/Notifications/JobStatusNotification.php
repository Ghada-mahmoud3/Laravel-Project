<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class JobStatusNotification extends Notification
{
    use Queueable;

    protected $job;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($job,$status)
    {
        $this->job = $job;
        $this->status=$status;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable): array
    {
        return [
            'message' => 'Your job "' . $this->job->title . '" has been ' . $this->status . '.',
            'job_id' => $this->job->id,
        ];
    }
}
