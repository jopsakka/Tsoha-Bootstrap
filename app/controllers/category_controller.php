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
			$category->save();
			Redirect::to('/task', array('message' => 'Luokka lisätty!'));
		}

		public static function index() {
			$categories = Category::all();
			View::make('category/index.html', array('categories' => $categories));
		}

		public static function destroy($id) {
			$category = new Category(array('id' => $id));
			$category->destroy();
			Redirect::to('/category');
		}
	}