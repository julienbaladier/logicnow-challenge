<?php


class MainController implements Controller{

	protected $model;
	protected $view;

	public function __construct($view){
		$this->view = $view;
		$this->model = new Model($view);
	}

	public function processRequest(){
		
		try{
			$this->model->processContactsRequest();
		}catch (Exception $e) {
			$this->view->displayErrorMessage("An error occurred : " . $e->getMessage());
		}
		
		$this->view->render();
	}

}


?>