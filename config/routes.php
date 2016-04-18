<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/task', function() {
    TaskController::index();
  });



  $routes->post('/task', function(){
    TaskController::store();
  });

  $routes->get('/task/new', function(){
    TaskController::create();
  });

  $routes->get('/task/:id', function($id){
    TaskController::show($id);
  });











  $routes->get('/muistilista/1', function() {
    HelloWorldController::askare();
  });

  $routes->get('/muistilista/1/muokkaus', function() {
    HelloWorldController::muokkaus();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
