<?php
	// Don't poison me with error messages
	error_reporting(0);
	
	// Mongolab DB info
	$MONGOLAB_API_KEY = 'YvpGKIHI0-i5YJgS_Z3AtcZrj1prgDWc';
	$DB = 'videos';
	$COLLECTION = 'videos';

	// Save ID of the YouTube video
	$id = $_POST['ID'];
	 
	$data = json_encode( array( "ID" => $id) );
	 
	$url = "https://api.mongolab.com/api/1/databases/$DB/collections/$COLLECTION?apiKey=$MONGOLAB_API_KEY";
	 
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
?>
