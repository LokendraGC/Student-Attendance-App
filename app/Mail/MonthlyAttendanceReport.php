<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MonthlyAttendanceReport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $period;
    public $filePath;

    public function __construct($period, $filePath)
    {
        $this->period = $period;
        $this->filePath = $filePath;
    }


    public function build()
    {
        return $this->markdown("mail.reports.attendance-report")->with([
            "period" => $this->period,
            "downloadUrl" => asset('storage/' .  $this->filePath),
        ])->attach(asset('storage/' .  $this->filePath));
    }


}
