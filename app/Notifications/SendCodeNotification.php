<?php

namespace App\Notifications;

use App\Notifications\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendCodeNotification extends Notification implements ShouldQueue
{
    use Queueable;
//    public $timeout = 20;
    public $code;
    public $mobile;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($code,$mobile=null)
    {
        $this->code=$code;
        $this->mobile=$mobile;
    }
    /*public function retryUntil(): \Illuminate\Support\Carbon
    {
        return now()->addSeconds(10);
    }*/
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return SmsChannel::class;
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
    public function toSms($notifiable){
//        return $this->code;
        return [
            $this->code,
            $this->mobile
        ];
    }
}
