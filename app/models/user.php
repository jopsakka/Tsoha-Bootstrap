<?php

class User extends BaseModel{
	public $id, $name, $password;

	public function __construct($attributes) {
		parent::__construct($attributes);
	}

	public static function authenticate($name, $password) {
		$query = DB::connection()->prepare('SELECT * FROM Player WHERE name = :name AND password = :password LIMIT 1');
		$query->execute(array('name' => $name, 'password' => $password));
		$row = $query->fetch();
		if($row){
		  	$user = new User(array(
		  		'id' => $row['id'],
		  		'name' => $row['name'],
		  		'password' => $row['password']
		  	));	
		  	return $user;
		}else{
		  	return NULL;
		}		
	}

	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM Player WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		if($row){
		  	$user = new User(array(
		  		'id' => $row['id'],
		  		'name' => $row['name'],
		  		'password' => $row['password']
		  	));	
		  	return $user;
		}else{
		  	return NULL;
		}		
	}
	public function getId() {
		return $this->id;
	}
}