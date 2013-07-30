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
    	$pdoMock = m::mock('PDO[query, FETCH_OBJ]');
    	$VideoManager = new VideoManager($pdoMock);

        $sql = "select * FROM videos ORDER BY title";

        $pdoMock->shouldReceive('query')->once()->with($sql)->andReturn($pdoMock);
        // 5 => constant value of PDO::FETCH_OBJ
        $pdoMock->shouldReceive('fetchAll')->once()->with(5)->andReturn(null);

        $response = $VideoManager->findAll();
	}

/*	public function testFindOne(){
        $pdoMock = m::mock('PDO');
        $VideoManager = new VideoManager($pdoMock);

        $id = 9;
        $sql = "SELECT * FROM videos WHERE id=".$id;

        $pdoMock->shouldReceive('prepare')->once()->with($sql)->andReturn($pdoMock);
        $pdoMock->shouldReceive('fetchObject')->once()->andReturn(array());

        $response = $VideoManager->findOne($id);
	}*/

   /* public function testAdd(){


    }
*/
   /* public function testDel(){
        $pdoMock = m::mock('PDO');
        $VideoManager = new VideoManager($pdoMock);

        $id = 9;
        $sql = "DELETE FROM videos WHERE id=".$id;

        $pdoMock->shouldReceive('prepare')->once()->with($sql)->andReturn($pdoMock);
        $pdoMock->shouldReceive('execute')->once()->andReturn(array());

        $response = $VideoManager->findOne($id);
    }*/
}

run(new VideoManager_test());
