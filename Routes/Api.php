<?php

use nobackend\{
    Application,
    Auth
};
use nobackend\Request\{
    ApiLoginRequest,
    ApiLogoutRequest,
    ApiRegisterRequest
};
use Symfony\Component\HttpFoundation\JsonResponse;


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
