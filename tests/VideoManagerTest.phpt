<?php
/*
 * Unit test of VideoManager class
 * ----------------------------
 * Author: Michal Dovičovič
 *
 */

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
        $VideoManager->shouldReceive('listAction')->andReturn(array());
        $response = $VideoManager->findAll();

        //$pdoMock->shouldReceive('query')->once()->withAnyArgs()->andReturn($statementMock);
        shouldReceive('fetchAll')->once()->with(PDO::FETCH_OBJ)->andReturn(null);

      //  Assert::equal(200, $response->statusCode);
        //Assert::equal('application/json', $response->contentType);
        //Assert::equal(array(), json_decode($response->content, true));


	}

	/*public function testFindOne(){
    	$pdoMock = m::mock('PDO');
        $VideoManager = new VideoManager($pdoMock);
        $VideoManager->shouldReceive('getAction')->andReturn(array());
        $response = $videoCtrl->listAction();
        Assert::equal(200, $response->statusCode);
        Assert::equal('application/json', $response->contentType);
        Assert::equal(array(), json_decode($response->content, true));


	}

    public function testAdd(){


    }

    public function testDel(){

    }*/
}

run(new VideoManager_test());
