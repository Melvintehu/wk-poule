<?php

namespace App\Plugins\Newsletter\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $newsletter;
    public $recipient;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($newsletter, $recipient)
    {
        $this->newsletter = $newsletter;
        $this->recipient = $recipient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@mentor4you')
        ->subject($this->newsletter['subject'])
        ->markdown('mails.newsletters.newsletter');
    }
}
