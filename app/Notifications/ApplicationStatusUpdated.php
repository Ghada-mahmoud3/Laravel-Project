<?php
namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ApplicationStatusUpdated extends Notification
{
    use Queueable;

    public $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello ' . $notifiable->name)
            ->line("Your application for '{$this->application->job->title}' has been {$this->application->status}.")
            ->action('View Application', url('/profile/applications'))
            ->line('Thank you for applying!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Your application for '{$this->application->job->title}' has been {$this->application->status}."
        ];
    }
}
