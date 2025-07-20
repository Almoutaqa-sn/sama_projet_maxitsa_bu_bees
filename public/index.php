<?php
// session_start();
// var_dump($_SESSION); die;
require_once __DIR__ . '/../vendor/autoload.php';
use App\Core\Router;
require_once __DIR__ . '/../routes/route.web.php';

Router::resolve($routes);

