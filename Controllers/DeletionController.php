<?php


class DeletionController extends MainController implements Controller{

	public function processRequest(){
		try{
			if (!empty($_POST['id'])) {
				$this->model->processDeletionRequest(intval($_POST['id']));
			}else{
				throw new Exception("Invalid input (an id must be specified for deletion).");
			}
		}catch (Exception $e) {
			$this->view->displayErrorMessage("An error occurred : " . $e->getMessage());
		}

		parent::processRequest();
	}



}


?>