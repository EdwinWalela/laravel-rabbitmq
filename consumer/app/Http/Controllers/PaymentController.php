<?php

namespace App\Http\Controllers;

use Anik\Amqp\Queues\Queue;
use Anik\Laravel\Amqp\Facades\Amqp;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function show(){
        $q = new Queue('payments');
        $func = function($data) { return $data; };
        Amqp::consume($func,'',null,$q);
        return(["msg"=>"ok"]);
    }
}
