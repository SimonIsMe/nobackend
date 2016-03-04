<?php


$app->get('/', function () use ($app)
{
    return $app['twig']->render('/System/index.twig');
});

$app->get('/login', function () use ($app)
{
    return $app['twig']->render('/System/login.twig');
});

$app->post('/login', function () use ($app)
{
    return 'zalogowano';
});

$app->get('/logout', function () use ($app)
{
    return $app['twig']->render('/System/logout.twig');
});