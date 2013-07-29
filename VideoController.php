<?php
class VideoController {
    private $VideoManager;
    public function __construct(VideoManager $VideoManager, $app){
        $this->VideoManager = $VideoManager;
        $this->app = $app;

    }
	public function listAction() {
        $var = $this->VideoManager->findAll();
        $this->app->response()->status(200);
	}

	public function getAction($id) {
		$var = $this->VideoManager->findOne($id);
	}

	public function addAction() {
		$app = \Slim\Slim::getInstance()->request();
		$data = json_decode($request->getBody());

		$var = $this->VideoManager->save($data);
        $this->app->response()->status(200);
	}

	public function delAction($id) {
		$var = $this->VideoManager->delete($id);
	}
}

