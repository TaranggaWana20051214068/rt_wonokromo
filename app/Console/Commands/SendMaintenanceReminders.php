<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MaintenanceSchedule;
use App\Notifications\MaintenanceReminderNotification;
use Carbon\Carbon;

class SendMaintenanceReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-maintenance-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $upcomingSchedules = MaintenanceSchedule::with('assignedTo')
            ->upcoming()
            ->whereDate('schedule_date', '>=', Carbon::now()->addDays(7))
            ->get();

        $overdueSchedules = MaintenanceSchedule::with('assignedTo')
            ->overdue()
            ->get();

        foreach ($upcomingSchedules as $schedule) {
            $schedule->assignedTo->notify(new MaintenanceReminderNotification($schedule, 'upcoming'));
        }

        foreach ($overdueSchedules as $schedule) {
            $schedule->assignedTo->notify(new MaintenanceReminderNotification($schedule, 'overdue'));
        }

        $this->info('Maintenance reminders sent successfully.');
    }
}
