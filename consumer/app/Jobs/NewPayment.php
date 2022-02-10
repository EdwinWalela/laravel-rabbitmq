<?php

namespace App\Jobs;

use Anik\Amqp\Queues\Queue;
use Anik\Laravel\Amqp\Facades\Amqp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $q = new Queue('payments');
        $func = function($data) { return $data; };
        Amqp::consume($func,'',null,$q);
        return(["msg"=>"ok"]);
    }

    public function failed()
{
    // error_log("failed");
}
}
