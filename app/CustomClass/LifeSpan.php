<?php

namespace App\CustomClass;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LifeSpan {

	private $trial_coins = 3; // Eur iniziali

	public function checkLifeSpan(Request $request){
		
		if( ! $request->cookie('trial_coins') ){
			return false;
		} else {
			return true;
		}
	}

	public function getBack(Request $request,$response){

		if( $this->checkLifeSpan($request) ){ // controllo sessione attiva

			$response['trial_coins'] = $request->cookie('trial_coins');
			$response['user'] = $request->cookie('user');
			return $response;

		} else {

			$response['trial_coins'] = $this->trial_coins;
			$response['user'] = time();

			return response($response)
				->withCookie(cookie('trial_coins',$response['trial_coins'], 1))
				->withCookie(cookie('user', $response['user'], 1));

		}

	}

	public function get_credito(){
		return $this->trial_coins;
	}

	public function add_credito($eur){
		$this->trial_coins += $eur;
	}

	

}