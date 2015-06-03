<?php

class Model{

	private $view;
	private $contact;


	public function __construct($view){
		$this->view = $view;
	}


	public function processContactsRequest(){

		try{
			
			$query_result = Database::getInstance()->query('SELECT * FROM contact');
		
			while($contact = $query_result->fetch(PDO::FETCH_ASSOC)) {
				$this->contact = Contact::fromDB($contact);
				$this->view->displayContact($this->contact);
			}

		}catch (Exception $e) {
			$this->view->displayErrorMessage("An error occurred : " . $e->getMessage());
		}
		
	}


	public function processDeletionRequest($id){

		try{

			$sth = Database::getInstance()->prepare("SELECT * FROM contact WHERE contact.id = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			if(!$sth->execute(array(':id' => $id))){
				throw new Exception("query to find contact to delete failed.");
			}


			if($result = $sth->fetch(PDO::FETCH_ASSOC)){
				$this->contact = Contact::fromUser($id, $result['first_name'], $result['last_name']);
				$this->contact->delete();
				/* success message */
				$this->view->displaySuccessMessage("Contact successfully deleted !");
			}else{
				throw new Exception("impossible to delete an unknown contact.");
			}


		}catch (Exception $e) {
			$this->view->displayErrorMessage("An error occurred : " . $e->getMessage());
		}
		
	}

	public function processAdditionModificationRequest($id, $first_name, $last_name){
		try{
			$this->contact = Contact::fromUser($id, $first_name, $last_name);
			$sth = Database::getInstance()->prepare("SELECT * FROM contact WHERE contact.id = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			
			if(!$sth->execute(array(':id' => $id))){
				throw new Exception("query to know if the contact exists or not failed.");
			}

			if ($result = $sth->fetch(PDO::FETCH_ASSOC)) {
				/* Contact already exist, we just need to update if it's needed */
				$this->contact->update();
				$this->view->displaySuccessMessage("Contact properly updated !");
			}else{
				/* Contact does not exist we need to create it */
				$this->contact->save();
				$this->view->displaySuccessMessage("Contact properly added !");
			}

		}catch (Exception $e) {
			$this->view->displayErrorMessage("An error occurred : " . $e->getMessage());
		}

	}


}


?>