<?php

namespace App\Mail;

use App\AlphaKey;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Date;

class AlphaKeyMail extends Mailable
{
    use Queueable, SerializesModels;

    public AlphaKey $alphaKey;

    /**
     * Create a new message instance.
     *
     * @param AlphaKey $alphaKey
     * @return void
     */
    public function __construct(AlphaKey $alphaKey)
    {
        $this->alphaKey = $alphaKey;
    }

    /**
     * Send the message using the given mailer.
     *
     * @param  \Illuminate\Contracts\Mail\Factory|\Illuminate\Contracts\Mail\Mailer  $mailer
     * @return void
     */
    public function send($mailer)
    {
        parent::send($mailer);

        $this->alphaKey->update([
            'mail_sent_at' => Date::now()
        ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.alpha-key');
    }
}
