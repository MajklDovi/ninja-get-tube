<?php
 
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
 
$app->get('/videos', 'getVideos');
$app->get('/', 'getVideos');
$app->post('/add', 'addVideo');
$app->post('/', 'addVideo');
$app->delete('/videos/:id',   'deleteVideo');
 
$app->run();
 
function getVideos() {
    $sql = "select * FROM videos ORDER BY title";
    try {
        $db = getConnection();
        $stmt = mysql_query($sql);
        
		echo '[';
		$comma = False;
		while ($row = mysql_fetch_assoc($stmt)) {
			if ($comma){
				echo ',';
			}
			$comma = True;
			$videos->id = $row["id"];
			$videos->title = $row["title"];
			$videos->image = $row["image"];
			$videos->author = $row["author"];
			$videos->description = $row["description"];
			$videos->link = $row["link"];
			
			echo json_encode($videos);
			
		}
		echo ']';
		mysql_free_result($stmt);
	}
	catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}
 

 
function addVideo() {
    $request = \Slim\Slim::getInstance()->request();
    $video = json_decode($request->getBody());

    $sql = "INSERT INTO videos (id, title, image, author, link, description) VALUES ('$video->id', '$video->title', '$video->image', '$video->author', '$video->link', '$video->description')";
    try {
        $db = getConnection();
        $retval = mysql_query($sql, $db);  
		if(!$retval) {
			die('Could not enter data: ' . mysql_error());
		}  
		mysql_close($db);
	}catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
    
    
}
 
function deleteVideo() {
	
}

function getConnection() {
	$db = mysql_connect('localhost:/var/run/mysql/mysql.sock', 'xdovic00', 'ciso7fun');
    	if (!$db) die('nelze se pripojit '.mysql_error());
    	if (!mysql_select_db('xdovic00', $db)) die('database neni dostupna '.mysql_error());
	return $db;
}

?>
