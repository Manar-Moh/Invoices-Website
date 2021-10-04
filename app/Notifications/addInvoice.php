<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class addInvoice extends Notification
{
    use Queueable;
    private $invoice_id;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice_id,$user)
    {
        $this->invoice_id = $invoice_id;
        $this->user = $user;
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
        $url = 'http://127.0.0.1:8000/invoiceDetails/'.$this->invoice_id;

        return (new MailMessage)
                    ->subject('New Invoice Was Added')
                    ->greeting('Hello!'.$this->user)
                    ->line('There Is A New Invoice Was Added To Invoices.')
                    ->action('Show Invoice',$url)
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
}
