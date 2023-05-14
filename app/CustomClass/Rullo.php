<?php

namespace App\CustomClass;

use App\CustomClass\CombinazioniVincenti as CombinazioniVincenti; 
use App\CustomClass\LifeSpan; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class Rullo {

	private $cifre;  
	private	$combinazionivincenti;
	private	$eur_giocata;            // costo ogni giro di rullo
	private	$posso_giocare = false;  // flag risultante da insieme di condizioni per la giocata ( credito e tempo non scaduto)

	public function __construct(LifeSpan $life_span){

		$this->eur_giocata = config('constants.slot.cost_each_play');

		if( ($life_span->get_credito() >= $this->eur_giocata) && $life_span->time_not_expired() ){

			$this->combinazionivincenti = new CombinazioniVincenti;
			$life_span->subtract_credito($this->eur_giocata);
			$this->cifre = [rand(0,9),rand(0,9),rand(0,9)];
			$this->posso_giocare = true;

		} else {
			
			$this->cifre = [0,0,0];

		}

	}

	public function ho_vinto(LifeSpan $life_span){

		$ho_vinto = $this->combinazionivincenti->controlla_vincita($this->cifre);

		if( $ho_vinto ) $life_span->add_credito($ho_vinto['eur']); 

		return $ho_vinto;

    }

    public function mostra_cifre(){
    	return $this->cifre;
    }

    public function get_eur_giocata(){
    	return $this->eur_giocata;
    }

    public function posso_giocare(){
    	return $this->posso_giocare;
    }


}

