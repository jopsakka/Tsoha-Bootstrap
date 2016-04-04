<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/muistilista', function() {
    HelloWorldController::muistilista();
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
