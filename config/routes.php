<?php
  
  function check_logged_in() {
    BaseController::check_logged_in();
  }
  $routes->post('/logout', function(){
    UserController::logout();
  });

  $routes->get('/','check_logged_in', function() {
    TaskController::index();
  });

  $routes->get('/task','check_logged_in', function() {
    TaskController::index();
  });

  $routes->get('/login', function(){
    UserController::login();
  });
  
  $routes->post('/login', function(){
    UserController::handle_login();
  });

  $routes->get('/category','check_logged_in', function(){
    CategoryController::index();
  });



  $routes->post('/task','check_logged_in', function(){
    TaskController::store();
  });

  $routes->get('/task/new','check_logged_in', function(){
    TaskController::create();
  });

  $routes->get('/category/new','check_logged_in', function(){
    CategoryController::create();
  });

  $routes->post('/category','check_logged_in', function(){
    CategoryController::store();
  });

  $routes->post('/category/:id/destroy','check_logged_in', function($id){
    CategoryController::destroy($id);
  });
    $routes->get('/category/:id/edit','check_logged_in', function($id) {
    CategoryController::edit($id);
  });

  $routes->post('/category/:id/edit','check_logged_in', function($id){
    CategoryController::update($id);
  });

  $routes->get('/task/:id','check_logged_in', function($id){
    TaskController::show($id);
  });

  $routes->get('/task/:id/edit','check_logged_in', function($id) {
    TaskController::edit($id);
  });

  $routes->post('/task/:id/edit','check_logged_in', function($id){
    TaskController::update($id);
  });

  $routes->post('/task/:id/destroy','check_logged_in', function($id){
    TaskController::destroy($id);
  });










  $routes->get('/muistilista/1', function() {
    HelloWorldController::askare();
  });

  $routes->get('/muistilista/1/muokkaus', function() {
    HelloWorldController::muokkaus();
  });



  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
