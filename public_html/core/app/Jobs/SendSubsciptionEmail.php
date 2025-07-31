<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\SubscriptionMailing;
use App\Models\Subscription;
use App\Models\User;
use DB;

class SendSubsciptionEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    public $timeout = 18000; // 2 hours

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
      $data = Subscription::where('status',1)->get();
      $bulk_data = $this->details['bulk_data'];  
      $info['bulk_data'] = $bulk_data;
      $input['subject'] = $bulk_data->subject;

      foreach ($data as $key => $value) {
          $info['email'] = $value->email;
          $input['email'] = $value->email;
          $input['name'] = "";
          \Mail::send('email.bulk-email', $info, function($message) use($input){
             $message->to($input['email'], $input['name'])
                     ->subject($input['subject']);
          });
        }
    }
}
