<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;



class JustTesting extends Mailable
{
    use Queueable, SerializesModels;
   public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Order Status')
            ->from('3e5cd9b257-1d3fc0@inbox.mailtrap.io', 'Sender')
            ->greeting('Hello!')
            ->line('Your order status has been updated')
            ->action('Check it out', url('/'))
            ->line('Best regards!');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('This is Testing Mail')
            ->view('mail.template');
    }
}
