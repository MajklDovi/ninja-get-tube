<?php
require 'vendor/autoload.php';
$app = new \Slim\Slim();

error_reporting(E_ALL|E_STRICT);

$db = new PDO('mysql:host=127.0.0.1;dbname=mikko', 'Mikko', 'megabuilders');
$VideoManager = new VideoManager($db);
$VideoController = new VideoController($VideoManager);

// define routes 
$app->get('/videos', array($VideoController , 'listAction'));
$app->get('/videos/:id', array($VideoController, 'getAction'));
$app->post('/add', array($VideoController , 'addAction'));
$app->delete('/videos/:id', array($VideoController , 'delAction'));

// application run
$app->run();

