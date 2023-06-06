<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\MySim;
use App\Events\newOrder;
use App\Events\simAlert as alert;
use App\Notifications\SimAlert;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class changeStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:status';

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
        $sims = MySim::all();
        $users = User::where('id', 1)->first();
        event(new alert());

        foreach ($sims as $sim){

           $data =  $sim->where('end_date','=',Carbon::today()->format('Y-m-d'))->first();
           $user_create = $data->client->name;
           if($data){
            Notification::send($users, new SimAlert($data->id, $user_create));


           }else{
            return false;
           }
           

        }
    }
}
