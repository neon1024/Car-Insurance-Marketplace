<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountCreationSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $email;
    public string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function build()
    {
        return $this->from(config('address'), config('name'))
            ->subject('Account Creation Successful')
            ->view('emails.account_confirmation')
            ->with([
                'email' => $this->email,
                'password' => $this->password,
            ]);
    }
}
