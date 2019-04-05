<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailVerify extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }


    public function build()
    {
        return $this->from('register@salesideas.ru')
            ->subject('Test email send')
            ->view('emailverify')
            ->with('user',$this->user);
    }
}
