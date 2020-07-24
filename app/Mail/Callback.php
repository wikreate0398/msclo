<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Callback extends Mailable
{
    use Queueable, SerializesModels;

    private $phone;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(setting('mailbox'))
                    ->subject('☆'.config('app.name').': Новое сообщение')
                    ->markdown('mails.callback')
                    ->with([
                        'phone' => $this->phone
                    ]);
    }
}
