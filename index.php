<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();


/************ MONGOLAB SETTINGS ************/	
// Don't poison me with error messages
error_reporting(0);

// Mongolab DB info
$MONGOLAB_API_KEY = 'YvpGKIHI0-i5YJgS_Z3AtcZrj1prgDWc';
$DB = 'videos';
$COLLECTION = 'videos';

$url = "https://api.mongolab.com/api/1/databases/$DB/collections/$COLLECTION?apiKey=$MONGOLAB_API_KEY";
/*******************************************/

// GET route
$app->get('/', function () {
    // Get ID of the YouTube video
	$request = Slim::getInstance()->request();
    $video = json_decode($request->getBody());
	$id = "3f3n4DZvaIg";
	$data = json_encode( array( "ID" => $id) );
		
	// Save ID on MongoLab
    try { 
	  $ch = curl_init();
	 
	  curl_setopt($ch, CURLOPT_URL, $url);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($ch, CURLOPT_POST, 1);
	  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  'Content-Type: application/json',
		  'Content-Length: ' . strlen($data),
		  )
	  );
	  $response = curl_exec($ch);
	  $error = curl_error($ch);
	  $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	  curl_close($ch);
	 
	  echo "OK";
	} catch (Exception $e) {
	  echo "FAIL";
	}
});
// POST route
$app->post('#/videos', function () {

	  $response = "dobre"

	 
});
// DELETE route
$app->delete('/delete', function () {
    echo 'This is a DELETE route';
});

// Run application
$app->run();




function getVideos() {

}



function getVideo() {
	// Get ID of the YouTube video
	$request = Slim::getInstance()->request();
    $video = json_decode($request->getBody());
	$id = $video->ID;
	$data = json_encode( array( "ID" => $id) );
		
	// Save ID on MongoLab
    try { 
	  $ch = curl_init();
	 
	  curl_setopt($ch, CURLOPT_URL, $url);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($ch, CURLOPT_POST, 1);
	  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  'Content-Type: application/json',
		  'Content-Length: ' . strlen($data),
		  )
	  );
	  $response = curl_exec($ch);
	  $error = curl_error($ch);
	  $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	  curl_close($ch);
	 
	  echo "OK";
	} catch (Exception $e) {
	  echo "FAIL";
	}
}
