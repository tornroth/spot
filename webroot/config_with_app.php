<?php
/**
 * Config file for pagecontrollers, creating an instance of $app.
 *
 */

// Get environment & autoloader.
require __DIR__.'/config.php'; 

// Create services
$di  = new \Anax\DI\CDIFactoryDefault();

// Include support for database
$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/database_mysql.php');
    $db->connect();
    return $db;
});

// Include controllers for users
$di->setShared('UsersController', function() use ($di) {
    $controller = new \Rcus\Users\CUsersController();
    $controller->setDI($di);
    return $controller;
});

// Include controllers for questions
$di->setShared('QuestionsController', function() use ($di) {
    $controller = new \Rcus\Questions\CQuestionsController();
    $controller->setDI($di);
    return $controller;
});


// Inject services into the app.
$app = new \Anax\Kernel\CAnax($di);
