<?php
/*
 * Unit test of VideoCtrl class
 * ----------------------------
 * Author: Michal Dovičovič
 *
 */
use Tester\Assert;
require __DIR__."/bootstrap.php";
use Mockery as m;

class VideoCtrl_test  extends Tester\TestCase{
    protected function tearDown(){
        parent::tearDown();
        m::close();
    }

	public function testListAction(){
	    $pdoMock = m::mock('PDO');
	    $app = m::mock('app');
	    $videoManager = m::mock('VideoManager', array($pdoMock));
        $videoController = new VideoController($videoManager, $app);

        $app->shouldReceive('status');
        $app->shouldReceive('response')->once()->andReturn($app);
        $videoManager->shouldReceive('findAll')->once()->andThrow('\PDOException');
        // Fatal error: Class '\PDOException' not found in /home/mikko/ninja-get-tube/vendor/mockery/mockery/library/Mockery/Expectation.php on line 403
        $videoManager->shouldReceive('findAll')->once()->andReturn(array());
        $videoController->listAction();
	}

	public function testAddAction(){
	    $pdoMock = m::mock('PDO');
        $app = m::mock('app');
        $videoManager = m::mock('VideoManager', array($pdoMock));
        $videoController = new VideoController($videoManager, $app);

        $data = array (
            "title" => "title of the video",
            "author" => "author of the video",
            "image" => "image link",
            "description" => "some new video",
            "link" => "http://www.youtube.com/watch?v=dsf4cv",
            "p" => "dsf4cv"
        );

/*        $app->shouldReceive('status');
        //$app->shouldReceive('request')->once()->andReturn(array());
        $app->shouldReceive('response')->once()->andReturn($app);
        $videoManager->shouldReceive('save')->once()->with($data)->andReturn(array());
        $videoController->addAction();*/
	}

	public function testGetAction(){
	    $pdoMock = m::mock('PDO');
        $app = m::mock('app');
        $videoManager = m::mock('VideoManager', array($pdoMock));
        $videoController = new VideoController($videoManager, $app);

        $id = 9;

        $app->shouldReceive('status');
        $app->shouldReceive('response')->once()->andReturn($app);
        $videoManager->shouldReceive('findOne')->once()->andReturn(array());
        $videoController->getAction($id);
	}

	public function testDelAction(){
	    $pdoMock = m::mock('PDO');
        $app = m::mock('app');
        $videoManager = m::mock('VideoManager', array($pdoMock));
        $videoController = new VideoController($videoManager, $app);

        $id = 9;

        $app->shouldReceive('status');
        $app->shouldReceive('response')->once()->andReturn($app);
        $videoManager->shouldReceive('delete')->once()->andReturn(0);
        $videoController->delAction($id);
	}
}
run(new VideoCtrl_test());
