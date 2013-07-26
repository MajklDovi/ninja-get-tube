<?php
/*
 * Unit test of VideoManager class
 * ----------------------------
 * Author: Michal Dovičovič
 *
 */

require "bootstrap.php";
use Mockery as m;

class VideoMngr_test extends Tester\TestCase{
    protected function tearDown(){
        parent::tearDown();
        m::close();
    }
	public function testFindAll(){
    	$dbServiceMock = m::mock('VideoManager');
        //$dbServiceMock->shouldReceive('listAction')->andReturn(array());
        $videoManager = new VideoManager();
        $response = $videoManager->findAll();
        Assert::equal(200, $response->statusCode);
        Assert::equal('application/json', $response->contentType);
        Assert::equal(array(), json_decode($response->content, true));


	}

	public function testFindOne(){
    	$dbServiceMock = m::mock('VideoManager');
        $dbServiceMock->shouldReceive('getAction')->andReturn(array());
        $videoCtrl = new VideoManager($dbServiceMock);
        $response = $videoCtrl->listAction();
        Assert::equal(200, $response->statusCode);
        Assert::equal('application/json', $response->contentType);
        Assert::equal(array(), json_decode($response->content, true));


	}

    public function testAdd(){
        $dbServiceMock = m::mock('VideoManager');
        $dbServiceMock->shouldReceive('addAction')->andReturn(array());
        $videoCtrl = new VideoManager($dbServiceMock);
        $response = $videoCtrl->listAction();
        Assert::equal(200, $response->statusCode);
        Assert::equal('application/json', $response->contentType);
        Assert::equal(array(), json_decode($response->content, true));


    }

    public function testDel(){
        $dbServiceMock = m::mock('VideoManager');
        $dbServiceMock->shouldReceive('delAction')->andReturn(array());
        $videoCtrl = new VideoManager($dbServiceMock);
        $response = $videoCtrl->listAction();
        Assert::equal(200, $response->statusCode);
        Assert::equal('application/json', $response->contentType);
        Assert::equal(array(), json_decode($response->content, true));


    }
}

run(new VideoMngr_test());
?>