<?php
 
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
 
// define routes 
$app->get('/videos', 'getVideos');
$app->get('/', 'getVideos');
$app->get('/videos/:id', 'getVideo');
$app->post('/add', 'addVideo');
$app->post('/', 'addVideo');
$app->delete('/videos/:id', 'deleteVideo');
 
// application run
$app->run();
 
// GET all videos
function getVideos() {
	// SQL select
    $sql = "select * FROM videos ORDER BY title";
    try {
		// connect to database
        $db = getConnection();
        $stmt = mysql_query($sql);
        
        // making of JSON format (there is no comma at the beginning)
		echo '[';
		$comma = False;
		while ($row = mysql_fetch_assoc($stmt)) {
			if ($comma){
				echo ',';
			}
			// allow comma between video JSONs
			$comma = True;
			$videos->id = $row["id"];
			$videos->title = $row["title"];
			$videos->image = $row["image"];
			$videos->author = $row["author"];
			$videos->description = $row["description"];
			$videos->link = $row["link"];
			
			echo json_encode($videos);
			
		}
		// end of JSON
		echo ']';
		// set them free
		mysql_free_result($stmt);
	}
	catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}
 
// GET video by id 
function getVideo($id){
	// SQL select
    $sql = ("SELECT * FROM videos WHERE id='$id'");
    try {
		// connect to dabase
        $db = getConnection();
        // apply deleting command
        $stmt = mysql_query($sql, $db);
        
        if(!$stmt) {
			// return Status Code (video is not in DB)
			header("HTTP/1.0 404 Not Found");
		}
        while ($row = mysql_fetch_assoc($stmt)) {
			// allow comma between video JSONs
			$comma = True;
			$videos->id = $row["id"];
			$videos->title = $row["title"];
			$videos->image = $row["image"];
			$videos->author = $row["author"];
			$videos->description = $row["description"];
			$videos->link = $row["link"];
			
			echo json_encode($videos);
			
		}
		// set them free
		mysql_close($db);
		
		// return Status Code
		header("HTTP/1.0 200 OK");
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}	
}
 
 

// INSERT video
function addVideo() {
	// reading request
    $request = \Slim\Slim::getInstance()->request();
    $video = json_decode($request->getBody());
	
	// SQL insert
    $sql = "INSERT INTO videos (id, title, image, author, link, description) VALUES ('$video->id', '$video->title', '$video->image', '$video->author', '$video->link', '$video->description')";
    try {
		// connect to database
        $db = getConnection();
        // apply inserting command
        $retval = mysql_query($sql, $db);  
		if(!$retval) {
			die('Could not enter data: ' . mysql_error());
		}  
		
		// get all videos from database
		$sql = "select * FROM videos ORDER BY title";
		$stmt = mysql_query($sql);
        
        // making of JSON format (there is no comma at the beginning)
		echo '[';
		$comma = False;
		while ($row = mysql_fetch_assoc($stmt)) {
			if ($comma){
				echo ',';
			}
			// allow comma between video JSONs
			$comma = True;
			$videos->id = $row["id"];
			$videos->title = $row["title"];
			$videos->image = $row["image"];
			$videos->author = $row["author"];
			$videos->description = $row["description"];
			$videos->link = $row["link"];
			
			echo json_encode($videos);
			
		}
		// end of JSON
		echo ']';
		
		// set them free
		mysql_close($db);
		
		// return Status Code
		header("HTTP/1.0 200 OK");
		
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}   
}
 
// DELETE video
function deleteVideo($id) {
	// SQL delete 
    $sql = ("DELETE FROM videos WHERE id ='$id'");
    try {
		// connect to dabase
        $db = getConnection();
        // apply deleting command
        $retval = mysql_query($sql, $db);

		if(!$retval) {
			// return Status Code (video is not in DB)
			header("HTTP/1.0 404 Not Found");
			die('Could not delete data: ' . mysql_error());
		}  
		// set them free
		mysql_close($db);
		
		// return Status Code
		header("HTTP/1.0 204 No Content");
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}	
}

function getConnection() {
	$db = mysql_connect('localhost:/var/run/mysql/mysql.sock', 'xdovic00', 'ciso7fun');
    	if (!$db) die('nelze se pripojit '.mysql_error());
    	if (!mysql_select_db('xdovic00', $db)) die('database neni dostupna '.mysql_error());
	return $db;
}

?>
