<?php
class VideoManager {
    private $db;
    public function __construct(PDO $db){
        $this->db = $db;

    }
	// insert into DB
	public function save($data) {
        $sql = "INSERT INTO videos (title, image, author, description, link, p) VALUES (:title, :image, :author, :description, :link, :p)";
        try {
            $db = $this->setup();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("title", $data->title);
            $stmt->bindParam("image", $data->image);
            $stmt->bindParam("author", $data->author);
            $stmt->bindParam("description", $data->description);
            $stmt->bindParam("link", $data->link);
            $stmt->bindParam("p", $data->p);
            $stmt->execute();
            $data->id = $db->lastInsertId();
            $db = null;
            echo json_encode($data);

        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
        return $data;
	}
	
	// find every video in DB
	public function findAll() {
		$sql = "select * FROM videos ORDER BY title";
		try {
            	$db = $this->setup();
        		$stmt = $db->query($sql);
        		$videos = $stmt->fetchAll(PDO::FETCH_OBJ);
        		$db = null;

			self::send($videos, False);
		} catch(Exception $e) {
			$app->response()->status(500);
		}
        return $data;
	}
	
	// find one video in DB
	public function findOne($id) {
		$sql = "SELECT * FROM videos WHERE id=:id";
        try {
            $db =  $this->setup();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->execute();
            $video = $stmt->fetchObject();
            $db = null;
        echo json_encode($video);

        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
	}
	
	// delete video from DB
	public function delete($id) {
        $sql = "DELETE FROM videos WHERE id=:id";
        try {
        $db = $this->setup();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->execute();
            $db = null;
        echo "video successfully deleted";
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
		
		
	}
	
	// send JSON to client
	public function send($videos, $one) {
		try {
			// making of JSON format (there is no comma at the beginning), one means one video
			if(!$one){
				echo '[';
			}
			$comma = False;
			// for each video export the data
			foreach ($videos as $video) {
				if ($comma){
					echo ',';
				}
				$comma = True;
				echo json_encode($video);
			}
			// end of JSON
			if(!$one){
				echo ']';
			}
		} catch(Exception $e) {
			$app->response()->status(500);
		}
	}

	public function setup() {
		// DB connect
        $db = new PDO('mysql:unix_socket=/var/run/mysql/mysql.sock;dbname=xdovic00', 'xdovic00', 'ciso7fun');

        if (!$db)
            die('nelze se pripojit');
        return $db;
	}
}
?>
