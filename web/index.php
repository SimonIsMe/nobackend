<?php

use nobackend\Application;
use nobackend\Request\ApiLoginRequest;
use nobackend\Request\ApiLogoutRequest;
use nobackend\Request\ApiRegisterRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

$loader = require_once __DIR__.'/../vendor/autoload.php';
$app = new Application();

$app->get('/api/v1/register', function ()
{
    $request = ApiRegisterRequest::createFromGlobals();
    if (false == $request->validate()) {
        return $request->getErrorResponse();
    }

    $email = $request->get('email');
    $password = $request->get('password');
    $passwordRepeat = $request->get('password_repeat');
    $projectId = $request->get('project_id');

//    Users::register($projectId, $email, $password);

    return new JsonResponse([
        'status' => Application::STATUS_SUCCESS
    ]);
});

$app->get('/api/v1/login', function ()
{
    $request = ApiLoginRequest::createFromGlobals();
    if (false == $request->validate()) {
        return $request->getErrorResponse();
    }

    $email = $request->get('email');
    $password = $request->get('password');
    $projectId = $request->get('project_id');

//    $success = Users::login($projectId, $email, $password);
//    if ($success) {
//        $sessionId = Users::getNewSessionId($projectId, $email);
//        return $app->json([
//            'status' => 'success',
//            'session_id' => $sessionId
//        ]);
//    }

    return new JsonResponse([
        'status' => Application::STATUS_SUCCESS
    ]);
});

$app->get('/api/v1/logout', function ()
{
    $request = ApiLogoutRequest::createFromGlobals();
    if (false == $request->validate()) {
        return $request->getErrorResponse();
    }

    $email = $request->get('email');
    $sessionId = $request->get('session_id');
    $projectId = $request->get('project_id');

//    Users::logout($projectId, $email, $sessionId);

    return new JsonResponse([
        'status' => Application::STATUS_SUCCESS
    ]);
});

$app->run();
