<?php
class VideoController {
    private $VideoManager;
    public function __construct(VideoManager $VideoManager){
        $this->VideoManager = $VideoManager;

    }
	public function listAction() {
        $var = $this->VideoManager->findAll();
	}

	public function getAction($id) {
		$var = $this->VideoManager->findOne($id);
	}

	public function addAction() {
		$request = \Slim\Slim::getInstance()->request();
		$data = json_decode($request->getBody());

		$var = $this->VideoManager->save($data);
	}

	public function delAction($id) {
		$var = $this->VideoManager->delete($id);
	}
}
?>
