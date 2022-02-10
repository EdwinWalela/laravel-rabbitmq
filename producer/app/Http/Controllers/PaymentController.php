<?php

namespace App\Http\Controllers;

use Anik\Laravel\Amqp\Facades\Amqp;
use App\Jobs\NewPayment;
use App\Jobs\PingJob;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

		private function parseJson($data){
			return $data;
		}

    public function create(){
        
			// Extract json body
			$payload = json_decode(request()->getContent(), true);

			// Format data
			$parsedJson = $this->parseJson($payload);

			// Publish formated data
			Amqp::publish($parsedJson);
			
			$res = [
				"msg"=>"ok"
			];

			return($res);
    }

    public function show(){
            
    }
}
