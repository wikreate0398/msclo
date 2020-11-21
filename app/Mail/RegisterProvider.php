<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterProvider extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(setting('mailbox'))
                    ->subject('☆'.config('app.name').': Регистрационые данные')
                    ->markdown('mails.data_user')
                    ->with([
                        'email' => $this->email,
                        'password' => $this->password,
                    ]);
    }
}
