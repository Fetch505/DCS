<?php

namespace App\Console\Commands;

use App\Models\Shift;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use App;
use Session;
use Illuminate\Console\Command;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class SendShiftNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shift:notify {--shiftId=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send shift notification to users 30 minutes before their shift starts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $shiftId = $this->option('shiftId');
        //Log::info('All options: ' . json_encode($this->option())); // Add this line
        //if (App::getLocale() == "en") {
        $title = "Shift Starts in 30 Minutes!";
        $body = 'Please make sure you\'re prepared and ready to go. Thank you for your dedication and hard work!';
        

        $time = now()->addMinutes(30)->format('H:i');
        $shift = Shift::where('id', '=', $shiftId)->first();

        //$users = $shift->users;
        
        // Log the value of $shiftId to a log file
        Log::info("Shift ID: $shiftId");

        $users = $shift->users->filter(function ($user) {
            return !is_null($user->shift_id);
        });
        $tokens = array();
        $reciverId = array();

        foreach ($users as $user) {
            $tokens[] = $user->fcm_token; 
            $reciverId[] = $user->id; 
        }

        $payLoadData= $this->multipleNotifications($title, $body, $tokens, $reciverId, $shift->company_id);
        
        
        //$this->info('Shift notifications sent successfully.');
        Log::info('Shift notifications sent successfully.');
    }

    public function multipleNotifications($title, $body,$tokens,$reciverId,$senderId)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
                                    ->setSound('default');

        /// Payload data ///
        $my_data = [
            'title' => $title,
            'body' => $body,
            'NotificationReceiversIds' => $reciverId,
            'NotificationSenderId' => $senderId,
        ];
        
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => $my_data]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        // return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

        // return Array (key : oldToken, value : new token - you must change the token in your database)
        $downstreamResponse->tokensToModify();

        // return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();

        // return Array (key:token, value:error) - in production you should remove from your database the tokens present in this array
        $downstreamResponse->tokensWithError();
        return $my_data;
    }
}
