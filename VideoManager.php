<?php
class VideoManager {
    private $db;
    public function __construct(PDO $db = null){
        $this->db = $db;

    }
	// insert into DB
	public function save($data) {
        $sql = "INSERT INTO videos (title, image, author, description, link, p) VALUES (:title, :image, :author, :description, :link, :p)";

        $db = $this->db;
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

        return $data;
	}
	
	// find every video in DB
	public function findAll() {
		$sql = "select * FROM videos ORDER BY title";

        $db = $this->db;
        $stmt = $db->query($sql);
        // 5 => constant value of PDO::FETCH_OBJ
        $videos = $stmt->fetchAll(5);
        $db = null;

        $this->send($videos, False);

        return $videos;
	}
	
	// find one video in DB
	public function findOne($id) {
		$sql = "SELECT * FROM videos WHERE id=:id";

        $db =  $this->db;
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $video = $stmt->fetchObject();
        $db = null;
        echo json_encode($video);

        return $video;
	}
	
	// delete video from DB
	public function delete($id) {
        $sql = "DELETE FROM videos WHERE id=:id";

        $db = $this->db;
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo "video successfully deleted";

        return 0;
	}
	
	// send JSON to client
	public function send($videos, $one) {
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
	}
}

