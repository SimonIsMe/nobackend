<?php

use nobackend\Application;
use nobackend\Translate;

define('APP_WEB', __DIR__ . '/web/');

$loader = require_once __DIR__.'/vendor/autoload.php';
$app = new Application();

function __($content, $language = null)
{
    $translate = Translate::getInstance();
    return $translate->translate($content, $language);
}