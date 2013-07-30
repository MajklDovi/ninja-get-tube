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
        } catch(RuntimeException $e) {
            $this->app->response()->status(500);
        }
        $this->app->response()->status(200);
	}

	public function getAction($id) {
		try {
            $var = $this->VideoManager->findOne($id);
        } catch(RuntimeException $e) {
            $this->app->response()->status(500);
        }
        $this->app->response()->status(200);
	}

	public function addAction() {
		//$app = $this->app->request();
		//$data = json_decode($request->getBody());
        $data = json_decode($this->app->request());
        try {
            $var = $this->VideoManager->save($data);
        } catch(RuntimeException $e) {
            $this->app->response()->status(500);
        }
        $this->app->response()->status(200);
	}

	public function delAction($id) {
		try {
            $var = $this->VideoManager->delete($id);
        } catch(RuntimeException $e) {
            $this->app->response()->status(500);
        }
        $this->app->response()->status(200);
	}
}

