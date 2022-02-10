<?php

namespace App\Http\Controllers;

use Anik\Amqp\Queues\Queue;
use Anik\Laravel\Amqp\Facades\Amqp;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function show(){
        // Declare queue
        $paymentsQueue = new Queue('payments');

        // Consume callback function
        $func = function($data) { return $data; };

        // Consume from queue
        Amqp::consume($func,'',null,$paymentsQueue);

        // Return response
        return(["msg"=>"ok"]);
    }
}
