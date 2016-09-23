<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/muistilista', function() {
    MuistiinpanoController::index();
});


$routes->get('/mp_muokkaus', function() {
    HelloWorldController::mp_muokkaus();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});

$routes->get('/muistiinpano', function() {
    HelloWorldController::muistiinpano();
});

$routes->post('/muistiinpano/new', function() {
    MuistiinpanoController::create();
});

//$routes->get('/muistiinpano/:id', function($id) {
//    MuistiinpanoController::show($id);
//});

