<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/muistilista', function() {
    HelloWorldController::muistilista();
  });
  
  $routes->get('/muistiinpano', function() {
    HelloWorldController::muistiinpano();
  });
  
  $routes->get('/mp_muokkaus', function() {
    HelloWorldController::mp_muokkaus();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });
