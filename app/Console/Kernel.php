<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Address;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            /*$addresses = Address::where('end_month',date('m'))->where('end_year',date('Y'))->get();
            $myfile = fopen("/home/mufeed/temp/testfile.txt", "a+");
            fwrite($myfile, "------------------------------------\nStarting at....".date('Ymdhs')."\n");
            foreach ($addresses as $key => $address) {
                if ($address->phone != "") {
                    fwrite($myfile, "Send SMS for ".$address->phone." at ".date('Ymdhs')." \n");
                }
            }
            fwrite($myfile, "Completed sending all sms at....".date('Ymdhs')."\n------------------------------------\n\n");
            fclose($myfile);*/
        })->everyMinute();
    }
}
