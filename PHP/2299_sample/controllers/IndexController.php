<?php
require_once('BaseController.php');

class IndexController extends BaseController {
	public function doRequest() {
		$this->view('home/home.php');
	}
}