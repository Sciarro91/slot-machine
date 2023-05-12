<?php

namespace App\CustomClass;

use App\CustomClass\CombinazioniVincenti as CombinazioniVincenti; 
use App\CustomClass\LifeSpan; 
use Illuminate\Http\Request;


class Rullo {

	private $cifre;  
	private	$combinazionivincenti;
	private	$eur_giocata = 2;        // costo ogni giro di rullo
	private	$posso_giocare = false;  // flag risultante da insieme di condizioni per la giocata ( credito e tempo non scaduto)

	public function __construct(LifeSpan $life_span){

		if( ($life_span->get_credito() >= $this->eur_giocata) && $life_span->time_not_expired() ){
			$this->combinazionivincenti = new CombinazioniVincenti;
			$life_span->subtract_credito($this->eur_giocata);
			$this->cifre = [rand(0,9),rand(0,9),rand(0,9)];
			$this->posso_giocare = true;

		} else {
			$this->combinazionivincenti = new CombinazioniVincenti;
			$this->cifre = [0,0,0];
			$this->posso_giocare = false;
		}

	}

	public function hoVinto(LifeSpan $life_span){

		$hoVinto = $this->combinazionivincenti->controllaVincita($this->cifre);

		if( $hoVinto ) $life_span->add_credito($hoVinto['eur']); 

		return $hoVinto;

    }

    public function mostraCifre(){
    	return $this->cifre;
    }

    public function get_eur_giocata(){
    	return $this->eur_giocata;
    }

    public function posso_giocare(){
    	return $this->posso_giocare;
    }


}

