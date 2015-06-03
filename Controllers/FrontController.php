<?php

class FrontController implements FromUser, Controller{

	private $controller;
	private $view;

	public function __construct(){
		$this->view = new View();
	}


	public function processAdditionModificationRequest(){
		$this->controller = new AdditionModificationController($this->view);
		$this->controller->processRequest();
	}

	public function processDeletionRequest(){
		$this->controller = new DeletionController($this->view);
		$this->controller->processRequest();
	}


	/* Dispatch user request to another controller able to process it */

	public function processRequest() {
		try {
			if (isset($_POST['action'])) {
				if ($_POST['action'] == 'delete') {
					$this->processDeletionRequest();
				}else if($_POST['action'] == 'add'){
					$this->processAdditionModificationRequest();
				}else{
					throw new Exception("Unknown action.");
				}
			}else {
				$this->controller = new MainController($this->view);
				$this->controller->processRequest();
			}
		}
		catch (Exception $e) {
			$this->view->displayErrorMessage("An error occured : " . $e->getMessage());
			$this->view->render();
		}
	}


}



?>