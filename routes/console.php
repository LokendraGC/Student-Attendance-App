<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Schedule::command('attendance:send-report daily')
//     ->everyTenSeconds('6:00')
//     ->timezone('Asia/Kathmandu');

// Schedule::command('attendance:send-report monthly')
//     ->monthlyOn(1, '8:00')
//     ->timezone('Asia/Kathmandu');

