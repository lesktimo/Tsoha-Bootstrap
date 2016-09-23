<?php

require 'app/models/Kategoria.php';
require 'app/models/Kayttaja.php';
require 'app/models/Muistiinpano.php';
require 'app/models/Muistilista.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox() {
        $ukkeli = Kayttaja::find(1);
        $kayttajat = Kayttaja::all();
        $kategoriat = Kategoria::all();
        $muistiinpanot = Muistiinpano::all();
        $muistilistat = Muistilista::all();
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        Kint::dump($kayttajat);
        Kint::dump($ukkeli);
        Kint::dump($kategoriat);
        Kint::dump($muistiinpanot);
        Kint::dump($muistilistat);
    }

    public static function muistilista() {
        View::make('suunnitelmat/muistilista.html');
    }

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
