<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\EmailTemplates;

class SendContactToProvider extends Notification
{
    use Queueable;

    private $postData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($postData)
    {
        $this->postData = $postData;
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
        $emailTemplate = EmailTemplates::where('var', 'provider_contact')->first();
        $message = str_replace(['{USERNAME}', '{PHONE}', '{EMAIL}', '{MESSAGE}'],
                               [$this->postData['name'], $this->postData['phone'], $this->postData['email'], $this->postData['message']],
                               $emailTemplate["message_{$notifiable->lang}"]);

        return (new MailMessage)
                    ->subject($emailTemplate["theme_{$notifiable->lang}"])
                    ->from(setting('mailbox')) 
                    ->line(new \Illuminate\Support\HtmlString($message));
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
