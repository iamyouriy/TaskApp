<?php
return
    [
	    '' =>
            [
                'controller' => 'home'
            ],
        
        '{page:\d+}' =>
            [
                'controller' => 'home'
            ],
        'taskApp' =>
            [
                'controller' => 'home'
            ],
        'taskApp/{page:\d+}' =>
            [
                'controller' => 'home',
            ],
           ];
