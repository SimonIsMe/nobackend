<?php

use nobackend\Translate;
use nobackend\Application;
use nobackend\Auth;
use nobackend\Request\ApiLoginRequest;
use nobackend\Request\ApiLogoutRequest;
use nobackend\Request\ApiRegisterRequest;
use Symfony\Component\HttpFoundation\JsonResponse;


$loader = require_once __DIR__.'/../vendor/autoload.php';
$app = new Application();

function __($content, $language = null)
{
    $translate = Translate::getInstance();
    return $translate->translate($content, $language);
}

$app->get('/api/v1/register', function ()
{
    $request = ApiRegisterRequest::createFromGlobals();
    if (false == $request->validate()) {
        return $request->getErrorResponse();
    }

    $email = $request->get('email');
    $password = $request->get('password');
    $projectId = $request->get('project_id');

    Auth::register($projectId, $email, $password);

    return new JsonResponse([
        'status' => Application::STATUS_SUCCESS
    ]);
});

$app->post('/api/v1/login', function ()
{
    $request = ApiLoginRequest::createFromGlobals();
    if (false == $request->validate()) {
        return $request->getErrorResponse();
    }

    $email = $request->get('email');
    $password = $request->get('password');
    $projectId = $request->get('project_id');

    $success = Auth::login($projectId, $email, $password);
    if ($success) {
        return new JsonResponse([
            'status' => Application::STATUS_SUCCESS,
            'session_id' => Auth::getNewSessionId($projectId, $email)
        ]);
    }

    return new JsonResponse([
        'status' => Application::STATUS_ERROR
    ]);
});

$app->post('/api/v1/logout', function ()
{
    $request = ApiLogoutRequest::createFromGlobals();
    if (false == $request->validate()) {
        return $request->getErrorResponse();
    }

    $email = $request->get('email');
    $sessionId = $request->get('session_id');
    $projectId = $request->get('project_id');

    Auth::logout($projectId, $email, $sessionId);

    return new JsonResponse([
        'status' => Application::STATUS_SUCCESS
    ]);
});

$app->run();
