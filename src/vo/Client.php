<?php

require_once(LIB_PATH.DS.'database.php');

class Client{
	
	private $username;
	private $password;
	private $firstName;
	private $middleName;
	private $lastName;
	private $address;
	private $mobile;
	
	protected static $dbFields = array("username", "password", "firstName", "middleName","lastName","address", "mobile");
	
	public function getUsername(){
		return $this->username;
	}
	
	public function setUsername($username){
	
		//set only if its not set, this function can be used when inserting a new client in database
		if(!isset($username)){
			$this->username = $username;
		}
	
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function setPassword($password){
		//set only if its not set, this function can be used when inserting a new client in database
		if(!isset($password)){
			$this->password = $password;
		}
	}
	
	public function getFirstName(){
		return $this->firstName;
	}
	
	public function setFirstName($firstName){
		$this->firstName = $firstName;
	}
	
	public function getLastName(){
		return $this->firstName;
	}
	
	public function setLastName($lastName){
		$this->lastName = $lastName;
	}
	
	public function getMiddleName(){
		return $this->middleName;
	}
	
	public function setMiddleName($middleName){
		$this->middleName = $middleName;
	}
	
	public function getAddress(){
		return $this->address;
	}
	
	public function setAddress($address){
		$this->address = $address;
	}
	
	public function getMobile(){
		return $this->mobile;
	}
	
	public function setMobile($mobile){
		$this->mobile = $mobile;
	}
	
	public function getFullName(){
		return $this->getFirstName() . " " . $this->getLastName();
	}
	
	public function hasAttribute($attribute) {
		return array_key_exists($attribute, $this->attributes());
	}
	
	public function attributes() {
		// return an array of attribute names and their values
		$attributes = array();
		foreach(self::$dbFields as $field) {
			if(property_exists($this, $field)) {
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	
	public static function authenticate($username="", $password="") {
		global $database;
		$username = $database->escape_value($username);
		$password = $database->escape_value($password);
	
		$sql  = "SELECT * FROM clients ";
		$sql .= "WHERE username = '{$username}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	
	public static function find_by_sql($sql="") {
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();
		while ($row = $database->fetch_array($result_set)) {
			$object_array[] = self::instantiate($row);
		}
		return $object_array;
	}
	
	
	public static function instantiate($record) {
		// Could check that $record exists and is an array
		$object = new client();
		// Simple, long-form approach:
		// $object->id 				= $record['id'];
		// $object->username 	= $record['username'];
		// $object->password 	= $record['password'];
		// $object->firstName = $record['firstName'];
		// $object->lastName 	= $record['lastName'];
	
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
			if($object->has_attribute($attribute)) {
				$object->$attribute = $value;
			}
		}
		return $object;
	}	
}

?>