<?php
use Src\Controller\SecurityController;
use Src\Controller\CompteController;


$routes = [


    '' => [
        'controller' => SecurityController::class,
        'method' => 'index'
    ],
 
    'createcompte' => [
        'controller' => SecurityController::class,
        'method' => 'createcompte'
    ],
    'accueil' => [
        'controller' => SecurityController::class,
        'method' => 'accueil',
    ],
    'compte' => [
        'controller' => CompteController::class,
        'method' => 'accueil',
    ],
];