<?php
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Muistilista!';
    }

    public static function sandbox(){
      $doom = new Task(array(
        'name' => 'd',
        'category' => '1',
        'importance' => '3',
        'description' => 'Boom, boom!'
      ));
      $errors = $doom->errors();

      Kint::dump($errors);
    }
    public static function muistilista(){
      View::make('suunnitelmat/muistilista.html');
    }

    public static function askare(){
      View::make('suunnitelmat/askare.html');
    }

    public static function muokkaus(){
      View::make('suunnitelmat/muokkaus.html');
    }

    public static function login(){
      View::make('suunnitelmat/login.html');
    }
  }
