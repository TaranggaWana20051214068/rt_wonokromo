<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\MaintenanceSchedule;
use Carbon\Carbon;

class MaintenanceReminderNotification extends Notification
{
    use Queueable;
    protected $schedule;
    protected $type;
    /**
     * Create a new notification instance.
     */
    public function __construct(MaintenanceSchedule $schedule, $type)
    {
        $this->schedule = $schedule;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $subject = $this->type == 'upcoming' ? 'Upcoming Maintenance Schedule' : 'Overdue Maintenance Schedule';
        $scheduleDate = Carbon::parse($this->schedule->schedule_date);
        $message = $this->type == 'upcoming' ? 'You have an upcoming maintenance schedule for ' . $this->schedule->asset->name . ' on ' . $scheduleDate->format('Y-m-d') : 'You have an overdue maintenance schedule for ' . $this->schedule->asset->name . ' on ' . $scheduleDate->format('Y-m-d');

        return (new MailMessage)
            ->subject($subject)
            ->line($message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
