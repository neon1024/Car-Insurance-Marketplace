<?php

namespace App\Services;

use App\Mail\AccountCreationSuccessMail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendAccountCreationSuccessMail(string $email, string $password): void
    {
        Mail::to($email)->send(new AccountCreationSuccessMail($email, $password));
    }

    public function sendPdf(string $email, string $decodedBase64Pdf, string $filename): void
    {
        Mail::send([], [], function ($message) use ($email, $decodedBase64Pdf, $filename) {
            $message->to($email)
                ->subject("Here is your PDF")
                ->from(config('from.address'), config('from.name'))
                ->setBody("", 'text/html')
                ->attachData($decodedBase64Pdf, $filename, [
                    'mime' => 'application/pdf',
                ]);
        });
    }
}
