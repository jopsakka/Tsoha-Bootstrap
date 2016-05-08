<?php

class Task extends BaseModel{
	
	public $id, $player_id, $name, $done, $description, $category, $importance, $added;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_name', 'validate_importance', 'validate_description');
	} 	

	public static function all($player_id) {
		$query = DB::connection()->prepare('SELECT * FROM Task WHERE player_id = :player_id ORDER BY done, importance DESC');
		$query->execute(array('player_id' => $player_id));
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

		return $tasks;
	}
	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$task = new Task(array(
				'id' => $row['id'],
				'player_id' => $row['player_id'],
				'name' => $row['name'],
				'done' => $row['done'],
				'description' => $row['description'],
				'category' => Category::find($row['category']),
				'importance' => $row['importance'],
				'added' => $row['added']
			));

			return $task;
		}
	}
  	public function save(){
  		$category_id = $this->category->id;
	    $query = DB::connection()->prepare('INSERT INTO Task (player_id, name, category, importance, description, done, added) VALUES (:player_id, :name, :category, :importance, :description, FALSE, NOW()) RETURNING id');
	    $query->execute(array('player_id' => $this->player_id,'name' => $this->name, 'category' => $category_id, 'importance' => $this->importance, 'description' => $this->description));
	    $row = $query->fetch();
	    $this->id = $row['id'];
  	}


  	public function update() {
  		$query = DB::connection()->prepare('UPDATE Task SET(name, category, importance, description, done)=(:name, :category, :importance, :description, :done) WHERE id = :id');
  		$teksti;
  		if ($this->done == TRUE) {
  			$teksti = 'TRUE';
  		} else {
  			$teksti = 'FALSE';
  		}
	    $query->execute(array('name' => $this->name, 'category' => $this->category, 'importance' => $this->importance, 'description' => $this->description, 'id' => $this->id, 'done' => $teksti));
  	}
  	public function destroy() {
   		$query = DB::connection()->prepare('DELETE FROM Task WHERE id = :id');
		$query->execute(array('id' => $this->id)); 		
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

  	public function validate_importance() {
  		$errors = array();
  		if (!is_numeric($this->importance)) {
  			$errors[] = 'Tärkeysasteen pitää olla numero!';
  		}
  		return $errors;
  	}

  	public function validate_description() {
  		$errors = array();
  		if(strlen($this->description) > 400) {
  			$errors[] = 'Kuvaus ei voi olla yli 400 merkkiä pitkä!';
  		}
  		return $errors;
  	}
}