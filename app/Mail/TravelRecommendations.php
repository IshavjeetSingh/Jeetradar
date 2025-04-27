<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TravelRecommendations extends Mailable
{
    use Queueable, SerializesModels;

    public $destinations;
    public $budget;
    public $startDate;
    public $endDate;
    public $activities;

    /**
     * Create a new message instance.
     */
    public function __construct($destinations, $budget, $startDate, $endDate, $activities)
    {
        $this->destinations = $destinations;
        $this->budget = $budget;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->activities = $activities;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Travel Recommendations from RoamRadar',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.recommendations',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
} 