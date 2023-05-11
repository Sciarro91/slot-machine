<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\CustomClass\CombinazioniVincenti as CombinazioniVincenti; 
use App\CustomClass\Rullo as Rullo; 

class GameController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function gioca(){

        $giocata = new Rullo;

        return ['rullo'=>$giocata->mostraCifre(),
                'hai_vinto'=> $giocata->hoVinto()
            ];
    }


    public function itera(){


        for ($i=0; $i < 1000; $i++) { 
           $giocata = self::gioca();
           if($giocata['hai_vinto']) $vincite[] = $giocata;
        }

        return $vincite;
    }
}
