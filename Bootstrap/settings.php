<?php
/**
 * Created by PhpStorm.
 * User: ALFAFA
 * Date: 12/13/2017
 * Time: 9:47 AM
 */


return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'db' =>
            [
                'driver'       => 'oracle',
                'host'         => '',
                'port'         => '1521',
                'database'     => '',
                'service_name' => '',
                'username'     => '',
                'password'     => '',
                'schema'       => '',
                'charset'      => 'AL32UTF8',
                'prefix'       => '',
            ]
    ]

];