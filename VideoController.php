<?php
class VideoController {
    private $VideoManager;
    public function __construct(VideoManager $VideoManager){
        $this->VideoManager = $VideoManager;

    }
	public function listAction() {
        $var = $this->VideoManager->findAll();
	}

	public static function getAction($id) {
		$var = $this->VideoManager->findOne($id);
	}

	public static function addAction() {
		$request = \Slim\Slim::getInstance()->request();
		$data = json_decode($request->getBody());

		$var = $this->VideoManager->save($data);
	}

	public static function delAction($id) {
		$var = $this->VideoManager->delete($id);
	}
}
?>
