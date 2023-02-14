<?php

namespace App\Console\Commands;

use App\Mail\RoomOpenNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class RoomOpenEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:roomopen {name} {email} {link}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email about open room';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Mail::to($this->argument('email'))->send(new RoomOpenNotification(
            $this->argument('name'),
            $this->argument('link')));

        return Command::SUCCESS;
    }
}
