<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox() {
        $kayttaja = Kayttaja::find(1);
        $kategoria = Kategoria::find(1);
        $muistiinpano = Muistiinpano::find(1);
        $muistilista = Muistilista::findKayttajalla(1);

        $kayttajat = Kayttaja::all();
        $kategoriat = Kategoria::all();
        $muistiinpanot = Muistiinpano::all();
        $muistilistat = Muistilista::all();

        Kint::dump($kayttaja);
        Kint::dump($kategoria);
        Kint::dump($muistiinpano);
        Kint::dump($muistilista);

        Kint::dump($kayttajat);
        Kint::dump($kategoriat);
        Kint::dump($muistiinpanot);
        Kint::dump($muistilistat);
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
