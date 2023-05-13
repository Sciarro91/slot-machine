<?php
    
    use Illuminate\Support\Facades\Facade;
    use Illuminate\Support\ServiceProvider;

    return [

        'user' => [
            'initial_credit' => 6, // 6 eur
            'expire_time' => 0.5, // min - 30 sec
        ],

        'admin' => [
            'initial_credit' => 99999999, 
            'expire_time' => 3600*24, 
        ],
           
        'slot' => [
                'cost_each_play' => 2  // 2 eur
        ],
     
    ];
