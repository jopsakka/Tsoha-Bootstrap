<?php
	class CategoryController extends BaseController{
		public static function create() {
			View::make('category/new.html');
		}
		public static function store() {
			$params = $_POST;
			$attributes = array(
				'name' => $params['name']
			);
			$category = new Category($attributes);
			$errors = $category->errors();
			if (count($errors) == 0) {
				$category->save();
				Redirect::to('/task', array('message' => 'Luokka lisätty!'));				
			} else {
				View::make('category/new.html', array('errors' => $errors));
			}

		}

		public static function index() {
			$categories = Category::all();
			View::make('category/index.html', array('categories' => $categories));
		}

		public static function destroy($id) {
			$category = new Category(array('id' => $id));
			if ($category->voikoPoistaa()) {
				$category->destroy();
				Redirect::to('/category');				
			} else {
				Redirect::to('/category', array('message' => 'Luokkaa ei voi poistaa jos se on käytössä jollain askareella!'));
			}

		}

		public static function edit($id) {
			$category = Category::find($id);
			View::make('category/edit.html', array('attributes' => $category));
		}

		public static function update($id) {
			$params = $_POST;
			$attributes = array(
				'id' => $id,
				'name' => $params['name']
			);

			$category = new Category($attributes);
			$errors = $category->errors();
			if (count($errors) > 0) {
				View::make('category/edit.html', array('errors' => $errors, 'attributes' => $category));	
			} else {
				$category->update();
				Redirect::to('/category', array('message' => 'Luokkaa muokattu onnistuneesti!'));
			}
		}
	}