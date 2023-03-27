<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\AllergyReport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AllergyReportApprovedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $allergyReport;

    public function __construct(AllergyReport $allergyReport)
    {
        $this->allergyReport = $allergyReport;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/');

        return (new MailMessage)
            ->subject('Persetujuan Laporan ALergi')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Laporan Alergi Anda telah disetujui oleh Keasramaan.')
            ->line('Allergies: ' . $this->allergyReport->allergies)
            ->action('View Report', $url)
            ->line('Terimakasih !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
