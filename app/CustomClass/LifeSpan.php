<?php

namespace App\CustomClass;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LifeSpan {

	private $trial_coins = 5; // Eur iniziali
	private $user; // idUtente - time di accesso
	private $req;  // tengo la request per comodità
	private $new_tkn; // se devo settare un nuovo utente

	public function __construct(Request $request){

		$this->req = $request;

		if( $this->checkCookie() ){ // controllo presenza cookie utente
			
			$this->user = $this->req->cookie('try_for_some_min');
			$this->new_tkn = false;

		} else { // se non c'è inizializzo nuovo utente

			$this->user = time(); // idUtente
			$this->req->session()->put('credit_usr_'.$this->user, $this->trial_coins);
			$this->new_tkn = true;

		}
	}

	public function checkCookie(){
		
		if( ! $this->req->cookie('try_for_some_min') ){
			return false;
		} else {
			return true;
		}
	}

	public function getBack($response){

		if( $this->new_tkn ){

			return response($response)
					->withCookie(cookie('try_for_some_min',$this->user));

		} else {

			return response($response);

		}
		

	}

	public function get_credito(){

		return $this->req->session()->get('credit_usr_'.$this->user);
	}

	public function add_credito($eur){

		$this->req->session()->put('credit_usr_'.$this->user, Session::get('credit_usr_'.$this->user) + $eur);

	}

	public function subtract_credito($eur){

		$this->req->session()->put('credit_usr_'.$this->user, Session::get('credit_usr_'.$this->user) - $eur);

	}

	public function time_not_expired(){
		return( ((time() - $this->user) / 60) <= 1 );
	}

	

}