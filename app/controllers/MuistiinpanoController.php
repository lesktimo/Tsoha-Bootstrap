<?php

class MuistiinpanoController extends BaseController {

    public static function index() {
        $muistiinpanot = Muistiinpano::all();
        View::make('muistiinpano/index.html', array('muistiinpanot' => $muistiinpanot));
    }

    public static function show($id) {
        $muistiinpano = Muistiinpano::find($id);
        View::make('muistiinpano/show.html', array('muistiinpano' => $muistiinpano));
    }

    public static function create() {

        View::make('muistiinpano/new.html');
    }

    public static function store() {
        $params = $_POST;
//        date_default_timezone_set('Europe/Finland');
        $lisatty = date("Y-m-d");
        $attributes = array(
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'prioriteetti' => $params['prioriteetti'],
            'kategoria_id' => $params['kategoria_id'],
            'lisatty' => $lisatty
        );
        $muistiinpano = new Muistiinpano($attributes);
        $errors = $muistiinpano->errors();
        if (count($errors) == 0) {
            $muistiinpano->save();
            Redirect::to('/muistiinpano/' . $muistiinpano->id, array('message' => 'Muistiinpano on lisätty listaasi!'));
        } else {
            View::make('muistiinpano/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    
}
