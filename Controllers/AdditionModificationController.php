<?php

class AdditionModificationController extends MainController implements Controller{

	public function processRequest(){
		try{
			if (!empty($_POST['id']) && !empty($_POST['first_name']) && !empty($_POST['last_name'])) {
				$this->model->processAdditionModificationRequest(intval($_POST['id']), $_POST['first_name'], $_POST['last_name']);
			}else{
				throw new Exception("invalid input (an id, a first name and a last name must be specified for creation/modification).");
			}
		}catch (Exception $e) {
			$this->view->displayErrorMessage("An error occurred : " . $e->getMessage());
		}

		parent::processRequest();
	}



}


?>