<?php
	class TaskController extends BaseController {

		public static function create() {
			View::make('task/new.html');
		}

		public static function store(){
    		$params = $_POST;
    		$task = new Task(array(
      			'name' => $params['name'],
      			'description' => $params['description'],
      			'class' => $params['class'],
      			'importance' => $params['importance']
    		));
    		$task->save();
    		Redirect::to('/task/' . $task->id, array('message' => 'Askare on lisätty muistilistaan!'));
  		}

		public static function index() {
			$tasks = Task::all();

			View::make('task/index.html', array('tasks' => $tasks));
		}

		public static function show($id) {
			$task = Task::find($id);

			View::make('task/task.html', array('task' => $task));
		}
	}