<?php

namespace App\CustomClass;


class CombinazioniVincenti {

    ## Si vince con: 
    
    private static $combinazionivincenti =
            [
                [ 'cmb' => [9,9,9],             'eur' => 3*9  ],       // 3 numeri uguali
                [ 'cmb' => [8,8,8],             'eur' => 3*8  ],       // 3 numeri uguali
                [ 'cmb' => [7,7,7],             'eur' => 3*7  ],       // 3 numeri uguali
                [ 'cmb' => [6,6,6],             'eur' => 3*6  ],       // 3 numeri uguali
                [ 'cmb' => [5,5,5],             'eur' => 3*5  ],       // 3 numeri uguali
                [ 'cmb' => [4,4,4],             'eur' => 3*4  ],       // 3 numeri uguali
                [ 'cmb' => [3,3,3],             'eur' => 3*3  ],       // 3 numeri uguali
                [ 'cmb' => [2,2,2],             'eur' => 3*2  ],       // 3 numeri uguali
                [ 'cmb' => [1,1,1],             'eur' => 3*1  ],       // 3 numeri uguali
                [ 'cmb' => [9,9,'[0-9]'],       'eur' => 9*2  ],       // 2 Nove
                [ 'cmb' => [9,'[0-9]',9],       'eur' => 9*2  ],       // 2 Nove
                [ 'cmb' => ['[0-9]',9,9],       'eur' => 9*2  ],       // 2 Nove
                [ 'cmb' => [8,8,'[0-9]'],       'eur' => 8    ],       // 2 Otto
                [ 'cmb' => [8,'[0-9]',8],       'eur' => 8    ],       // 2 Otto
                [ 'cmb' => ['[0-9]',8,8],       'eur' => 8    ],       // 2 Otto
                [ 'cmb' => [8,8,'[0-9]'],       'eur' => 8    ],       // 2 Otto
                [ 'cmb' => ['[0-9]','[0-9]',9], 'eur' => 9    ],       // 1 Nove                    
                [ 'cmb' => ['[0-9]',9,'[0-9]'], 'eur' => 9    ],       // 1 Nove
                [ 'cmb' => [9,'[0-9]','[0-9]'], 'eur' => 9    ]        // 1 Nove
            ]; 


    public function controllaVincita($rullo){

        foreach (self::$combinazionivincenti as $combinazionevincente) {
            if( preg_match('/'.implode('', $combinazionevincente['cmb']).'/', implode('', $rullo ) ) == 1 ) return $combinazionevincente;
        }

        return false;
    }

}