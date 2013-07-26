<?php
/*
 * Unit test of VideoCtrl class
 * ----------------------------
 * Author: Michal Dovičovič
 *
 */

require "bootstrap.php";
use Mockery as m;

class VideoCtrl_test  extends Tester\TestCase{
    protected function tearDown(){
        parent::tearDown();
        m::close();
    }

	public function testListAction(){
        $videoManager = new videoManager();
        $response = $videoManager->findAll();
        Assert::equal(200,$response->statusCode);
        Assert::equal('application/json', $response->contentType);
        Assert::equal(array(), json_decode($response->content, true));
	}

	public function testAddAction(){
        $videoManager = new videoManager();
        $data = array (
            "title" => "title",
            "image" => "none",
            "author" => "author",
            "description" => "adding",
            "link" => "http://www.youtube.com/watch?v=LYtiDCXLAcQ",
            "p" => "LYtiDCXLAcQ"
        );
        $response = $videoManager->save($data);
        Assert::equal(200,$response->statusCode);
        Assert::equal('application/json', $response->contentType);
        Assert::equal($data, json_encode($response->content));
	}

	public function testGetAction(){
        $id = 9;
        $videoManager = new videoManager();
        $response = $videoManager->findOne($id);
        Assert::equal(200,$response->statusCode);
        Assert::equal('application/json', $response->contentType);
        Assert::equal("Eva - Nightwish", json_encode($response->title));
	}

	public function testDelAction(){
        $id = 9;
        $videoManager = new videoManager();
        $response = $videoManager->delete($id);
        Assert::equal(200,$response->statusCode);
        Assert::equal('application/json', $response->contentType);
        Assert::equal("Eva - Nightwish", json_encode($response->title));
	}
}
run(new VideoCtrl_test());
?>