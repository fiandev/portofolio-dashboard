<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Inbox;

class InboxReceived extends Mailable
{
    use Queueable, SerializesModels;
    private $inbox;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Inbox $inbox)
    {
      $this->inbox = $inbox;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
          ->from(env("MAIL_FROM_ADDRESS"))
          ->subject("Email notification for inbox received")
          ->markdown("emails.inbox.notify", [
             "inbox" => $this->inbox
           ]);
    }
}
