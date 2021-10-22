<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendUserInvitationLink extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
        $this->subject = 'Schleier IT wants you to be part of the family.';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.sendUserInvitationLink')
                ->from('noreply@test.com')
                ->subject($this->subject)
                ->to($this->email);
    }

}
