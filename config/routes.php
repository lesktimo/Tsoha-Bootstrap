<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

$routes->get('/', 'check_logged_in', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/muistilista', 'check_logged_in', function() {
    MuistiinpanoController::index();
});


$routes->get('/mp_muokkaus', function() {
    HelloWorldController::mp_muokkaus();
});

$routes->get('/login', function() {
    KayttajaController::login();
});

$routes->post('/login', function() {
    KayttajaController::handle_login();
});

$routes->post('/muistiinpano', 'check_logged_in', function() {
    MuistiinpanoController::store();
});

$routes->get('/muistiinpano/new', 'check_logged_in', function() {
    MuistiinpanoController::create();
});

$routes->get('/muistiinpano/:id', 'check_logged_in', function($id) {
    MuistiinpanoController::show($id);
});

$routes->get('/muistiinpano/:id/edit', 'check_logged_in', function($id) {
    MuistiinpanoController::edit($id);
});
$routes->post('/muistiinpano/:id/edit', 'check_logged_in', function($id) {
    MuistiinpanoController::update($id);
});

$routes->post('/muistiinpano/:id/destroy', 'check_logged_in', function($id) {
    MuistiinpanoController::destroy($id);
});

$routes->post('/logout', function(){
  KayttajaController::logout();
});