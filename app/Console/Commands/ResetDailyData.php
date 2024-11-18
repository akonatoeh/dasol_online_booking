<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\BookingOther;

class ResetDailyData extends Command
{
    protected $signature = 'reset:daily-data';
    protected $description = 'Reset daily data in the system';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Reset daily_count to 0 in the bookings table
        Booking::query()->update(['daily_count' => 0]);
        BookingOther::query()->update(['daily_count' => 0]);
        // Log success
        $this->info('Daily data has been reset successfully.');
    }
}