<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\OTP;

class OTP_Code extends Mailable
{
    use Queueable, SerializesModels;
    private $otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(OTP $otp)
    {
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $otp = $this->otp;
        
        return $this
          ->from(env("MAIL_FROM_ADDRESS"))
          ->subject("Email Verification for ". $otp->email)
          ->markdown("emails.register.otp", [
             "otp" => $otp
           ]);
    }
}
