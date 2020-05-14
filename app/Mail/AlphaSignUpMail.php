<?php

namespace App\Mail;

use App\AlphaSignUp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlphaSignUpMail extends Mailable
{
    use Queueable, SerializesModels;

    public AlphaSignUp $alphaSignUp;

    /**
     * Create a new message instance.
     *
     * @param AlphaSignUp $alphaSignUp
     */
    public function __construct(AlphaSignUp $alphaSignUp)
    {
        $this->alphaSignUp = $alphaSignUp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.alpha-sign-up');
    }
}
