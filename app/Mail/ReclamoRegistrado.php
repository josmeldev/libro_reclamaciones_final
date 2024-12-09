<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReclamoRegistrado extends Mailable
{
    use Queueable, SerializesModels;

    public $reclamo;
    public $persona;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reclamo, $persona)
    {
        $this->reclamo = $reclamo;
        $this->persona = $persona;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reclamo_registrado')
                    ->subject('Reclamo Registrado')
                    ->with([
                        'reclamo' => $this->reclamo,
                        'persona' => $this->persona,
                    ]);
    }
}
