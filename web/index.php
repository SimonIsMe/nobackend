<?php


require '../bootstrap.php';

$app->get('/hello', function () use ($app) {
    return $app['twig']->render('hello.twig');
});

require_once '../Routes/Api.php';
require_once '../Routes/System.php';

$app->run();
