<?php

namespace App\CustomClass;

use App\CustomClass\CombinazioniVincenti as CombinazioniVincenti; 


class Rullo {

	private $cifre;
	private	$combinazionivincenti;

	public function __construct(){

		$this->combinazionivincenti = new CombinazioniVincenti;
		$this->cifre = [rand(0,9),rand(0,9),rand(0,9)];

	}

	public function hoVinto(){

		return $this->combinazionivincenti->controllaVincita($this->cifre);

    }

    public function mostraCifre()
    {
    	return $this->cifre;
    }


}

