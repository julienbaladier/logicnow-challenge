<?php

class Contact{

	private $id;
	private $first_name;
	private $last_name;


	//Constructors

	public static function fromUser($id, $first_name, $last_name){
		$contact = new Contact();
		$contact->id = $id;
		$contact->first_name = $first_name;
		$contact->last_name = $last_name;
		return $contact;
	}


	public static function fromDB($request_response){
		$contact = new Contact();
		$contact->id = $request_response["id"];
		$contact->first_name = $request_response["first_name"];
		$contact->last_name = $request_response["last_name"];
		return $contact;
	}


	public function update(){
		$sth = Database::getInstance()->prepare('UPDATE contact
	 											 SET contact.first_name = :first_name, contact.last_name = :last_name
	 											 WHERE contact.id = :id', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		if(!$sth->execute(array(':id' => $this->id, ':first_name' => $this->first_name, ':last_name' => $this->last_name))){
			throw new Exception("query to update a contact failed.");
		}
	}


	public function save(){
		$sth = Database::getInstance()->prepare('INSERT INTO contact(id, first_name, last_name)
	 											 VALUES (:id, :first_name, :last_name)', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		if(!$sth->execute(array(':id' => $this->id, ':first_name' => $this->first_name, ':last_name' => $this->last_name))){
			throw new Exception("query to save a contact failed.");
		}
	}

	public function delete(){
		$sth = Database::getInstance()->prepare("DELETE FROM contact WHERE contact.id = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		if(!$sth->execute(array(':id' => $this->id))){
			throw new Exception("query to delete a contact failed.");
		}
	}


	/*
	* getters, setters & toString methods
	*/

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setFirstName($first_name){
		$this->first_name = $first_name;
	}

	public function getFirstName(){
		return $this->first_name;
	}

	public function setLastName($last_name){
		$this->last_name = $last_name;
	}

	public function getLastName(){
		return $this->last_name;
	}

	public function toString(){
		return "<span><strong>$this->id</strong></span> <span>$this->first_name</span> <span>$this->last_name</span>";
	}
}

?>