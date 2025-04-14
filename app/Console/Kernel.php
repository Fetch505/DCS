<?php

namespace App\Console;

use App\Models\Shift;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SendShiftNotifications::class,
        Commands\MaterialQuantityConsumption::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
{
    $schedule->command('materials:consume')->daily();

    $schedule->call(function () {
        try {
            $shifts = Shift::where('company_id', 512)
                ->select('id', 'time_starts', 'company_id')
                ->get();

            foreach ($shifts as $shift) {
                $project = Project::where('company_id', $shift->company_id)
                    ->select('country')->first();

                $country = $project->country ?? null;
                $countryTimezones = Config::get('countryTimezones');

                $timezonecountry = $country && isset($countryTimezones[$country])
                    ? $countryTimezones[$country]
                    : config('app.timezone');

                $startTime = $shift->time_starts;

                if (!is_null($startTime)) {
                    $startTime = date('Y-m-d H:i:s', strtotime($startTime));
                    $startTime = Carbon::createFromFormat('Y-m-d H:i:s', $startTime, $timezonecountry)
                        ->setTimezone(config('app.timezone'))
                        ->format('H:i:s');
                }

                $time = date('H:i', strtotime('-30 minutes', strtotime($startTime)));

                $schedule->command("shift:notify --shiftId={$shift->id}")->dailyAt($time);
            }
        } catch (\Exception $e) {
            Log::error('Failed to schedule shift notifications: ' . $e->getMessage());
        }
    })->daily();
}

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
