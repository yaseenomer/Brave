<?php
/**
 * Created by PhpStorm.
 * User: ALFAFA
 * Date: 12/13/2017
 * Time: 9:48 AM
 */

use Yajra\Oci8\Oci8Connection;
use Yajra\Oci8\Connectors\OracleConnector as Connector;


$capsule = new \Illuminate\Database\Capsule\Manager();

$capsule->addConnection($DI['settings']['db']);

$capsule->bootEloquent();

$capsule->setAsGlobal();

$capsule->getDatabaseManager()->extend('oracle', function ($config) {
    $connector = new Connector();
    $connection = $connector->connect($config);
    $db = new Oci8Connection($connection, $config['database'], $config['prefix']);

    // set oracle session variables
    $sessionVars = [
        'NLS_TIME_FORMAT'         => 'HH24:MI:SS',
        'NLS_DATE_FORMAT'         => 'YYYY-MM-DD HH24:MI:SS',
        'NLS_TIMESTAMP_FORMAT'    => 'YYYY-MM-DD HH24:MI:SS',
        'NLS_TIMESTAMP_TZ_FORMAT' => 'YYYY-MM-DD HH24:MI:SS TZH:TZM',
        'NLS_NUMERIC_CHARACTERS'  => '.,',
    ];

    // Like Postgres, Oracle allows the concept of "schema"
    if (isset($config['schema'])) {
        $sessionVars['CURRENT_SCHEMA'] = $config['schema'];
    }

    $db->setSessionVars($sessionVars);

    return $db;
});

$DI['db']  = function ($Di) use ($capsule) {
    return $capsule;
};

$DI['HomeController'] = function ($DI){
    return new \App\Controllers\HomeController($DI);
};

$DI['user'] = function ($DI){
    return new \App\Models\User();
};