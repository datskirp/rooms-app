<?php

namespace App\Console;

use App\Models\Room;
use App\Models\RoomUser;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $roomsToOpen = Room::whereDate('start_on', '<=', Carbon::today())
            ->whereDate('close_on', '>=', Carbon::today())
            ->whereTime('open_at', '=', Carbon::now())
            ->where('active', '=', 0)
            ->get();

        foreach ($roomsToOpen as $room) {
            $users = RoomUser::where('room_id', $room->id)->get();
            $room->active = 1;
            $room->save();
            foreach ($users as $user) {
                $schedule->command('mail:roomopen', [
                    $room->name,
                    $user->user_email,
                    $room->link,
                ])->everyMinute();
            }
        }
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
