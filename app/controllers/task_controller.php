<?php
	class TaskController extends BaseController {

		public static function create() {
			$categories = Category::all();
			View::make('task/new.html', array('categories' => $categories));
		}

		public static function store(){
    		$params = $_POST;
    		$category = Category::find($params['category']);
    		$user = self::get_user_logged_in();
			$user_id = $user->getId();
    		$attributes = array(
    			'player_id' => $user_id,
      			'name' => $params['name'],
      			'description' => $params['description'],
      			'category' => $params['category'],
      			'importance' => $params['importance']
    		);

    		$task = new Task($attributes);
    		$errors = $task->errors();

    		if (count($errors)==0) {
    			$task->save();
    			Redirect::to('/task/' . $task->id, array('message' => 'Askare on lisätty muistilistaan!'));
    		} else {
    			View::make('task/new.html', array('errors' => $errors, 'attributes' => $attributes));
    		}

  		}

		public static function index() {
			$user = self::get_user_logged_in();
			$user_id = $user->getId();
			$tasks = Task::all($user_id);

			View::make('task/index.html', array('tasks' => $tasks));
		}

		public static function show($id) {
			$task = Task::find($id);

			View::make('task/task.html', array('task' => $task));
		}

		public static function edit($id) {
			$task = Task::find($id);
			View::make('task/edit.html', array('attributes' => $task));
		}

		public static function update($id) {
			$params = $_POST;

			$attributes = array(
				'id' => $id,
				'name' => $params['name'],
				'done' => $params['done'],
				'category' => $params['category'],
				'importance' => $params['importance'],
				'description' => $params['description']
			);

			$task = new Task($attributes);
			$errors = $task->errors();

			if(count($errors) > 0) {
				View::make('task/edit.html', array('errors' => $errors, 'attributes' => $attributes));
			} else {
				$task->update();
				Redirect::to('/task/' . $task->id, array('message' => 'Askaretta muokattu onnistuneesti'));
			}
		}
		
		public static function destroy($id) {
			$task = new Task(array('id' => $id));
			$task->destroy();
			Redirect::to('/task', array('message' => 'Askare poistettu onnistuneesti'));
		}
	}