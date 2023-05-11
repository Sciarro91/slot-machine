<?php

namespace App\CustomClass;

use App\CustomClass\CombinazioniVincenti as CombinazioniVincenti; 
use App\CustomClass\LifeSpan; 


class Rullo {

	private $cifre;
	private	$combinazionivincenti;

	public function __construct(LifeSpan $life_span){

		if($life_span->get_credito() > 0 ){

			$this->combinazionivincenti = new CombinazioniVincenti;
			$this->cifre = [rand(0,9),rand(0,9),rand(0,9)];

		} else {
			return false;
		}

	}

	public function hoVinto(LifeSpan $life_span){

		$hoVinto = $this->combinazionivincenti->controllaVincita($this->cifre);

		if( $hoVinto ){

			$life_span->add_credito($hoVinto['eur']);

		} 

		return $hoVinto;

    }

    public function mostraCifre()
    {
    	return $this->cifre;
    }


}

