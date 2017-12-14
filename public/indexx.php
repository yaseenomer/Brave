<?php
/**
 * Created by PhpStorm.
 * User: ALFAFA
 * Date: 12/11/2017
 * Time: 8:57 AM
 */


require dirname(__DIR__).'/./vendor/autoload.php';


use Yajra\Oci8\Oci8Connection;
use Illuminate\Database\Capsule\Manager as Capsule;
use Yajra\Oci8\Connectors\OracleConnector as Connector;

$app = new Slim\App();
$capsule = new Capsule();

$capsule->addConnection(array(
    'driver'       => 'oracle',
    'host'         => '172.27.144.189',
    'port'         => '1521',
    'database'     => 'orcl',
    'service_name' => 'orcl',
    'username'     => 'mazin',
    'password'     => 'mazin',
    'schema'       => 'mazin',
    'charset'      => 'AL32UTF8',
    'prefix'       => '',
));

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


$app->get('/', function () use ($app, $capsule) {
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->write(json_encode((array) $capsule->table('users')->first()));
});

$app->run();
