<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Mail\ReservationReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendReservationReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = '予約日の当日朝にリマインドメールを送信';

    public function handle()
    {
        $today = now()->format('Y-m-d');

        $reservations = Reservation::whereDate('date', $today)->get();

        foreach ($reservations as $reservation) {
            Mail::to($reservation->reservedBy->email)->queue(
                new ReservationReminderMail($reservation)
            );
        }

        $this->info('Remind emails sent for ' . $reservations->count() . ' reservations.');
    }
}