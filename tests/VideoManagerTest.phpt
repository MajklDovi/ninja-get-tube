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
    	$pdoMock = m::mock('PDO');
    	$VideoManager = new VideoManager($pdoMock);

        $sql = "select * FROM videos ORDER BY title";

        $pdoMock->shouldReceive('query')->once()->with($sql)->andReturn($statementMock);
        //$pdoMock->shouldReceive('fetchAll')->once()->with(PDO::FETCH_OBJ)->andReturn(null);


        $response = $VideoManager->findAll();
      //  Assert::equal(200, $response->statusCode);
        //Assert::equal('application/json', $response->contentType);
        //Assert::equal(array(), json_decode($response->content, true));


	}

	public function testFindOne(){
/*    	$pdoMock = m::mock('PDO');
        $VideoManager = new VideoManager($pdoMock);

        $id = 9;
        $VideoManager->shouldReceive('findOne')->andReturn(array());


        $response = $videoManager->findOne($id);

        Assert::equal(200, $response->statusCode);
        Assert::equal('application/json', $response->contentType);
        Assert::equal(array(), json_decode($response->content, true));
*/

	}

   /* public function testAdd(){


    }

    public function testDel(){

    }*/
}

run(new VideoManager_test());
