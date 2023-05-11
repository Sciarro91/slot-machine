<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\CustomClass\Rullo as Rullo; 
use App\CustomClass\LifeSpan as LifeSpan; 

class GameController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function gioca(Request $request){

        $life_span = new LifeSpan($request);
        $giocata = new Rullo($life_span);

        if( $giocata ){

            $vincita = $giocata->hoVinto($life_span);

            $response = [
                'rullo'=>$giocata->mostraCifre(),
                'hai_vinto'=> $vincita,
                'credito' => $life_span->get_credito()
            ];

        } else {

            $response = [
                'rullo'=>null,
                'hai_vinto'=> null
            ];

        }

        return $life_span->getBack($request,$response);

    }


    public function itera(){


        for ($i=0; $i < 1000; $i++) {
           $giocata = self::gioca();
           if($giocata['hai_vinto']) $vincite[] = $giocata;
        }

        return $vincite;
    }
}
