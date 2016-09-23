<?php

class MuistiinpanoController extends BaseController {

    public static function index() {
        $muistiinpanot = Muistiinpano::all();
        View::make('muistiinpano/index.html', array('muistiinpanot' => $muistiinpanot));
    }

    public static function show() {
//        $muistiinpano = Muistiinpano::find($id);
//        View::make($muistiinpano);
        
    }

    public static function create() {

        View::make('muistiinpano/new.html');
    }

    public static function store() {
        $params = $_POST;
        $lisatty = date(YYYY - MM - DD);
        $muistiinpano = new Game(array(
            'name' => $params['name'],
            'kuvaus' => $params['kuvaus'],
            'prioriteetti' => $params['prioriteetti'],
            'kategoria_id' => $params['kategoria_id'],
            'lisatty' => $lisatty
        ));

        Kint::dump($params);

        $muistiinpano->save();
        Redirect::to('/muistiinpano/' . $muistiinpano->id, array('message' => 'Muistiinpano on lisätty listaasi!'));
    }

}
