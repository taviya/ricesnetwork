<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DynamicMail extends Mailable
{
    use Queueable, SerializesModels;
    public $view;
    public $dynamicData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($view, $dynamicData)
    {
        $this->dynamicData = $dynamicData;
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dynamicData = $this->dynamicData;
        return $this->view($this->view, compact('dynamicData'));
    }
}
