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
    KayttajaController::login();
});

$routes->post('/login', function(){
  // Kirjautumisen käsittely
  KayttajaController::handle_login();
});

$routes->post('/muistiinpano', function() {
    MuistiinpanoController::store();
});

$routes->get('/muistiinpano/new', function() {
    MuistiinpanoController::create();
});

$routes->get('/muistiinpano/:id', function($id) {
    MuistiinpanoController::show($id);
});

$routes->get('/muistiinpano/:id/edit', function($id) {
    MuistiinpanoController::edit($id);
});
$routes->post('/muistiinpano/:id/edit', function($id) {
    MuistiinpanoController::update($id);
});

$routes->post('/muistiinpano/:id/destroy', function($id) {
    MuistiinpanoController::destroy($id);
});
