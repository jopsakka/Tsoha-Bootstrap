<?php

class Task extends BaseModel{
	
	public $id, $player_id, $name, $done, $description, $class, $importance, $added;

	public function __construct($attributes){
		parent::__construct($attributes);
	} 	

	public static function all() {
		$query = DB::connection()->prepare('SELECT * FROM Task');
		$query->execute();
		$rows = $query->fetchAll();
		$tasks = array();

		foreach($rows as $row) {
			$tasks[] = new Task(array(
				'id' => $row['id'],
				'player_id' => $row['player_id'],
				'name' => $row['name'],
				'done' => $row['done'],
				'description' => $row['description'],
				'class' => $row['class'],
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
				'class' => $row['class'],
				'importance' => $row['importance'],
				'added' => $row['added']
			));

			return $task;
		}
	}
  	public function save(){
	    $query = DB::connection()->prepare('INSERT INTO Task (name, class, importance, description) VALUES (:name, :class, :importance, :description) RETURNING id');
	    $query->execute(array('name' => $this->name, 'class' => $this->class, 'importance' => $this->importance, 'description' => $this->description));
	    $row = $query->fetch();
	    $this->id = $row['id'];
  	}
}