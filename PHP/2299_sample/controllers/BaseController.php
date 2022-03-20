<?php
class BaseController {
	public function doRequest() {
		$action = getGet('action');

		switch($action) {
			case 'add':
				$this->add();
			break;
			case 'post':
				$this->post();
			break;
			case 'edit':
				$this->edit();
			break;
			case 'delete':
				$this->delete();
			break;
			case 'confirm-delete':
				$this->confirmDelete();
			break;
			case '':
			case 'index':
				$this->index();
			break;
			default:
				$this->doAction($action);
			break;
			//Viet them cac function cho controller nay.
		}
	}
	//list
	public function index() {}
	public function add() {}
	//submit form add/edit
	public function post() {}
	public function edit() {}
	public function delete() {}
	public function confirmDelete() {}
	public function doAction($action) {}

	//Loi goi hien thi view -> nhung html -> Hien thi du lieu View
	public function view($path, $arr = []) {
		foreach($arr as $key => $value) {
			$$key = $value;
		}
		// $x = 'Abc';
		// $$x = 10;//$Abc = 10

		include_once('../views/'.$path);
	}

	public function redirect($routeName) {
		header('Location: ?'.$routeName);
		die();
	}
}