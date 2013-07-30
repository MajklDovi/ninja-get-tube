<?php
class VideoController {
    private $VideoManager;
    public function __construct(VideoManager $VideoManager, $app){
        $this->VideoManager = $VideoManager;
        $this->app = $app;

    }
	public function listAction() {
        try {
            $var = $this->VideoManager->findAll();
            $this->app->response()->status(200);
        } catch(RuntimeException $e) {
            $this->app->response()->status(500);
        }
	}

	public function getAction($id) {
		try {
            $var = $this->VideoManager->findOne($id);
            $this->app->response()->status(200);
        } catch(RuntimeException $e) {
            $this->app->response()->status(500);
        }
	}

	public function addAction() {
		//$app = $this->app->request();
        $data = json_decode($this->app->request()->getBody(), true);
        try {
            $var = $this->VideoManager->save($data);
            $this->app->response()->status(200);
        } catch(RuntimeException $e) {
            $this->app->response()->status(500);
        }
	}

	public function delAction($id) {
		try {
            $var = $this->VideoManager->delete($id);
            $this->app->response()->status(200);
        } catch(RuntimeException $e) {
            $this->app->response()->status(500);
        }
	}
}

