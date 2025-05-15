<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewApplicationNotification extends Notification
{
    use Queueable;

    protected $application;

    public function __construct($application)
{
    $this->application = $application;
}


    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
{
    return [
        'message' => 'A new application was submitted for your job "' . $this->application->job->title . '" by ' . $this->application->user->name,
        'job_id' => $this->application->job_id,
    ];
}

}
