<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendEmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $materials_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($materials_data)
    {
        $this->materials_data = $materials_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->materials_data['subject'])
            ->from($this->materials_data['sender_name'])
            ->view('mail.sendNotification')->with(['materials' => $this->materials_data['materials']]);
    }
}
