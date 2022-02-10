<?php

namespace App\Http\Controllers;

use Anik\Laravel\Amqp\Facades\Amqp;
use App\Jobs\NewPayment;
use App\Jobs\PingJob;
use DateTime;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

		private function getDate($date){
			$d = DateTime::createFromFormat('d-m-Y H:i:s', $date);

			if ($d === false) {
					die("Incorrect date string");
			} else {
					return $d->getTimestamp();
			}
		}

		private function parseJson($data){
			// Parse data
			$body = json_decode($data,true);

			$parsed = [
				"amount" =>$body["amount"],
				"created_at"=>$this->getDate($body["timestamp"]),
				"account_number" =>$body["account_no"],
				"user_id"=>$body["user_no"]
			];
			
			return $parsed;
		}

    public function create(){
        
			// Extract json body
			$payload = json_decode(request()->getContent(), true);

			// Parse data
			$parsedJson = $this->parseJson($payload["data"]);

			// Publish formated data
			Amqp::publish(json_encode($parsedJson));

			error_log($parsedJson["account_number"]);
			
			$res = [
				"msg"=>"submitted for processing"
			];

			return($res);
    }
}
