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
	}