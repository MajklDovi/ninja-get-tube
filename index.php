<?php
require 'VideoManager.php'; // video manager
require 'VideoController.php'; // video controller
require 'vendor/autoload.php';
$app = new \Slim\Slim();

error_reporting(E_ALL|E_STRICT);

$db = new PDO('mysql:unix_socket=/var/run/mysql/mysql.sock;dbname=xdovic00', 'xdovic00', 'ciso7fun');
$VideoManager = new VideoManager($db);
$VideoController = new VideoController($VideoManager);

// define routes 
$app->get('/videos', array($VideoController , 'listAction'));
$app->get('/videos/:id', array($VideoController, 'getAction'));
$app->post('/add', array($VideoController , 'addAction'));
$app->delete('/videos/:id', array($VideoController , 'delAction'));

// application run
$app->run();

