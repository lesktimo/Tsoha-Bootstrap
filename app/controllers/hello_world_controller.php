<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox() {
        $testimuistiinpano = new Muistiinpano(array(
            'nimi' => 'aaa',
            'prioriteetti' => '5',
            'kuvaus' => 'd',
            'lisatty' => 'd',
        ));
        $errors = $testimuistiinpano->errors();
        kint::dump($errors);
    }

//    public static function muistilista() {
//        View::make('muistiinpano/index.html');
//    }

    public static function muistiinpano() {
        View::make('suunnitelmat/muistiinpano.html');
    }

    public static function mp_muokkaus() {
        View::make('suunnitelmat/mp_muokkaus.html');
    }

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

}
