<?php

class Category extends BaseModel {
	
	public $id, $name;
	
	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_name');
	}

	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM Category WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row) {
			$category = new Category(array(
				'id' => $row['id'],
				'name' => $row['name']

			));

			return $category;
		}
	}

	public static function all() {
		$query = DB::connection()->prepare('SELECT * FROM Category');
		$query->execute();
		$rows = $query->fetchAll();	
		$categories = array();

		foreach($rows as $row) {
			$categories[] = new Category(array(
				'id' => $row['id'],
				'name' => $row['name']
			));
		}

		return $categories;	
	}

	public function save() {
		$query = DB::connection()->prepare('INSERT INTO Category (name) VALUES (:name) RETURNING id');
	    $query->execute(array('name' => $this->name));
	    $row = $query->fetch();
	    $this->id = $row['id'];
	}

	public function voikoPoistaa() {
  		$query = DB::connection()->prepare('SELECT * FROM Task WHERE category = :category');
		$query->execute(array('category' => $this->id));
		$rows = $query->fetchAll();	
		$tasks = array();

		foreach($rows as $row) {
			$tasks[] = new Task(array(
				'id' => $row['id'],
				'player_id' => $row['player_id'],
				'name' => $row['name'],
				'done' => $row['done'],
				'description' => $row['description'],
				'category' => Category::find($row['category']),
				'importance' => $row['importance'],
				'added' => $row['added']
			));
		}
		if (count($tasks) > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
  	}

	public function destroy() {
		$query = DB::connection()->prepare('DELETE FROM Category WHERE id = :id');
		$query->execute(array('id' => $this->id)); 	
	}
	public function update() {
		$query = DB::connection()->prepare('UPDATE Category SET(name)=(:name) WHERE id = :id');
	    $query->execute(array('name' => $this->name, 'id' => $this->id));	
	}
	public function validate_name() {
  		$errors = array();
  		if($this->name == '' || $this->name == null){
    		$errors[] = 'Nimi ei saa olla tyhjä!';
  		}
  		if(strlen($this->name) < 3){
    		$errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä!';
  		}
  		if(strlen($this->name) > 50) {
  			$errors[] = 'Nimi ei voi olla yli 50 merkkiä!';
  		}

  		return $errors;
  	}

}