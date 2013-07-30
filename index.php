<?php
require __DIR__.'/vendor/autoload.php';
$app = new \Slim\Slim();

error_reporting(E_ALL|E_STRICT);
// 'mysql:host=127.0.0.1;dbname=mikko', 'Mikko', 'megabuilders'
// 'mysql:unix_socket=/var/run/mysql/mysql.sock;dbname=xdovic00', 'xdovic00', 'ciso7fun'
$db = new PDO('mysql:unix_socket=/var/run/mysql/mysql.sock;dbname=xdovic00', 'xdovic00', 'ciso7fun');
$VideoManager = new VideoManager($db);
$VideoController = new VideoController($VideoManager, $app);

// define routes
$app->get('/videos', array($VideoController , 'listAction'));
$app->get('/videos/:id', array($VideoController, 'getAction'));
$app->post('/add', array($VideoController , 'addAction'));
$app->delete('/videos/:id', array($VideoController , 'delAction'));

// application run
$app->run();

