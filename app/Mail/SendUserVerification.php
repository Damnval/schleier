<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendUserVerification extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
        $this->subject = 'Verify your account with Schleier IT';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.sendUserVerification')
                    ->with([
                        'tokenVar' => $this->token,
                        'userVar' => $this->user,
                    ])
                    ->from('noreply@test.com')
                    ->subject($this->subject)
                    ->to($this->user->email);
    }
}
