<?php

namespace Sparc\Vacancies\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Sparc\Vacancies\Enums\ApplicationStatus;

class ApplicationResult extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private string $applicant,
        private string $vacancy,
        private ApplicationStatus $status
    ) {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'RE: '.$this->vacancy,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = 'vacancies::mail.application-'.Str::lower($this->status->value);

        return new Content(
            view: $view,
            with: [
                'applicant' => $this->applicant,
                'vacancy' => $this->vacancy,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
