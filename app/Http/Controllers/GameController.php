<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

use App\CustomClass\Rullo as Rullo; 
use App\CustomClass\LifeSpan as LifeSpan; 


class GameController extends BaseController
{

    public function gioca(Request $request){

        
        $life_span = new LifeSpan($request);

        $giocata = new Rullo($life_span);
        
        if( $giocata->posso_giocare() ){

            $vincita = $giocata->hoVinto($life_span);

            $response = [
                'rullo'=>$giocata->mostraCifre(),
                'hai_vinto'=> $vincita,
                'credito' => $life_span->get_credito(),
                'msg' => $vincita ? 'Bravo!!!' : ''
            ];

        } else {

            $response = [
                'rullo'=>$giocata->mostraCifre(),
                'hai_vinto'=> null,
                'credito' => $life_span->get_credito(),
                'msg' => $life_span->time_not_expired() ? 'Credito non sufficiente! Riprova a giocare su slot-machine.net' : 'Tempo Scaduto! Continua a giocare su slot-machine.net'
            ];

        }

        return $response;

    }


    public function itera(Request $request){

        $vincite = array();

        for ($i=0; $i < 100; $i++) {
            $giocata = self::gioca($request);
            if($giocata->original['hai_vinto']){
                $vincite[] = $giocata->original['hai_vinto']['eur'];
            }
        }

        return $vincite;
    }

}
