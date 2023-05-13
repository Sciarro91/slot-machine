<?php

namespace App\CustomClass;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LifeSpan {

	private $trial_coins; // Eur iniziali
	private $time_user; // time di accesso
	private $req;  // tengo la request per comodità

	public function __construct(Request $request){
		$this->trial_coins = config('constants.user.initial_credit');
		$this->req = $request;

		if( $request->session()->has('user') ){ // controllo presenza cookie utente
			
			$this->time_user = Session::get('user'); // riprendo dalla sessione da quanto tempo è attivo

		} else { // se non c'è inizializzo nuovo utente

			$this->time_user = time(); // time di accesso Utente
			$this->req->session()->put('credit_usr', $this->trial_coins);
			$this->req->session()->put('user', $this->time_user);

		}
	}

	public function get_credito(){
		return $this->req->session()->get('credit_usr');
	}

	public function add_credito($eur){
		$this->req->session()->put('credit_usr', Session::get('credit_usr') + $eur);
	}

	public function subtract_credito($eur){
		$this->req->session()->put('credit_usr', Session::get('credit_usr') - $eur);
	}

	public function time_not_expired(){
		return( ((time() - $this->time_user) / 60) <= config('constants.user.expire_time') ); // 30 sec
	}

	

}