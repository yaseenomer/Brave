<?php
/**
 * Created by PhpStorm.
 * User: Yaseen Omar
 * Date: 12/13/2017
 * Time: 9:48 AM
 */


require __DIR__.'/../vendor/autoload.php';

require __DIR__.'/settings.php';

$app = new Slim\App(require __DIR__.'/settings.php');

$DI = $app->getContainer();

require __DIR__.'/DependenceyInjection.php';

require __DIR__.'/../router/web.php';