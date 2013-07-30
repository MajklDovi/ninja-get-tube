<?php
/*
 * Unit test of VideoManager class
 * ----------------------------
 * Author: Michal Dovičovič
 *
 */
use Tester\Assert;
require __DIR__."/bootstrap.php";
use Mockery as m;

class VideoManager_test extends Tester\TestCase{
    protected function tearDown(){
        parent::tearDown();
        m::close();
    }
	public function testFindAll(){
    	$pdoMock = m::mock('iConnection');
    	$stmtnMock = m::mock('stdClass');
    	$VideoManager = new VideoManager($pdoMock);

        $sql = "select * FROM videos ORDER BY title";

        $pdoMock->shouldReceive('query')->once()->with($sql)->andReturn($stmtnMock);
        // 5 => constant value of PDO::FETCH_OBJ
        $stmtnMock->shouldReceive('fetchAll')->once()->with(5)->andReturn(null);

        $response = $VideoManager->findAll();
	}

	public function testFindOne(){
        $pdoMock = m::mock('iConnection');
        $stmtnMock = m::mock('stdClass');
        $VideoManager = new VideoManager($pdoMock);

        $id = 9;
        $sql = "SELECT * FROM videos WHERE id=:id";

        $pdoMock->shouldReceive('prepare')->once()->with($sql)->andReturn($stmtnMock);
        $stmtnMock->shouldReceive('bindParam')->once()->with("id", $id)->andReturn($stmtnMock);
        $stmtnMock->shouldReceive('execute')->once()->andReturn($stmtnMock);
        $stmtnMock->shouldReceive('fetchObject')->once()->andReturn(array());

        $response = $VideoManager->findOne($id);
        Assert::equal($response, array());
	}

/*    public function testAdd(){
        $pdoMock = m::mock('iConnection');
        $stmtnMock = m::mock('stdClass');
        $VideoManager = new VideoManager($pdoMock);

        $data = array (
            "title" => "title of the video",
            "author" => "author of the video",
            "image" => "image link",
            "description" => "some new video",
            "link" => "http://www.youtube.com/watch?v=dsf4cv",
            "p" => "dsf4cv"
        );

        $sql = "INSERT INTO videos (title, image, author, description, link, p) VALUES (:title, :image, :author, :description, :link, :p)";

        $pdoMock->shouldReceive('prepare')->once()->with($sql)->andReturn($stmtnMock);
        $stmtnMock->shouldReceive('bindParam')->once()->with("title", $data->title)->andReturn($stmtnMock);
        $stmtnMock->shouldReceive('bindParam')->once()->with("image", $data->image)->andReturn($stmtnMock);
        $stmtnMock->shouldReceive('bindParam')->once()->with("author", $data->author)->andReturn($stmtnMock);
        $stmtnMock->shouldReceive('bindParam')->once()->with("description", $data->description)->andReturn($stmtnMock);
        $stmtnMock->shouldReceive('bindParam')->once()->with("link", $data->link)->andReturn($stmtnMock);
        $stmtnMock->shouldReceive('bindParam')->once()->with("p", $data->p)->andReturn($stmtnMock);
        $stmtnMock->shouldReceive('execute')->once()->andReturn($stmtnMock);
        $pdoMock->shouldReceive('lastInsertId')->once()->andReturn(7);

        $response = $VideoManager->save($data);
        Assert::equal($response, $data);
    }*/

    public function testDel(){
        $pdoMock = m::mock('iConnection');
        $stmtnMock = m::mock('stdClass');
        $VideoManager = new VideoManager($pdoMock);

        $id = 9;
        $sql = "DELETE FROM videos WHERE id=:id";

        $pdoMock->shouldReceive('prepare')->once()->with($sql)->andReturn($stmtnMock);
        $stmtnMock->shouldReceive('bindParam')->once()->with("id", $id)->andReturn($stmtnMock);
        $stmtnMock->shouldReceive('execute')->once()->andReturn($stmtnMock);

        $response = $VideoManager->findOne($id);
        Assert::equal($response, 0);
    }
}

run(new VideoManager_test());
