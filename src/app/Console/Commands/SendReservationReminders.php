<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Mail\ReservationReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendReservationReminders extends Command
{
    protected $signature = 'reminders:send-reservation';
    protected $description = 'Send reservation reminder emails at 7AM';

    public function handle()
    {
        $today = Carbon::today()->toDateString();

        $reservations = Reservation::with(['user', 'shop'])
        ->whereDate('date', $today)
        ->get();

        foreach ($reservations as $reservation) {
            Mail::to($reservation->user->email)
                ->send(new ReservationReminderMail($reservation));
        }

        $this->info('Reservation reminders sent.');
    }
}