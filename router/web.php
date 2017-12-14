<?php
/**
 * Created by PhpStorm.
 * User: ALFAFA
 * Date: 12/13/2017
 * Time: 9:51 AM
 */


$app->get('/', 'HomeController:index');


$app->get('/new',function (\Slim\Http\Request $request, \Slim\Http\Response $response) {
    // Use the PSR 7 $request object

    return $response;

});


