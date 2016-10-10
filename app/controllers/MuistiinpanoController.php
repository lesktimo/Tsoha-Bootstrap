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
        $kategoriat = Kategoria::all();
        View::make('muistiinpano/new.html', array('kategoriat' => $kategoriat));
    }

    public static function store() {
        $params = $_POST;
        $kategoriat = $params['kategoriat'];
        $lisatty = date("Y-m-d");
        $attributes = array(
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'prioriteetti' => $params['prioriteetti'],
            'lisatty' => $lisatty,
            'kategoriat' => array()
        );
        kint::dump($attributes);
        foreach ($kategoriat as $kategoria) {
            $attributes['kategoriat'][] = $kategoria;
        }
        kint::dump($attributes);
        $attributes['kategoriat'] = array_filter($attributes['kategoriat']);
        kint::dump($attributes);
        $muistiinpano = new Muistiinpano($attributes);
        $errors = $muistiinpano->errors();
        if (count($errors) == 0) {
            $muistiinpano->save();
            Redirect::to('/muistiinpano/' . $muistiinpano->id, array('message' => 'Muistiinpano on lisätty listaasi!'));
        } else {
            View::make('muistiinpano/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        $muistiinpano = Muistiinpano::find($id);
        $kategoriat = Kategoria::all();
        $kat_mp = array();
        kint::dump($muistiinpano);
        foreach ($muistiinpano->kategoriat as $kategoria) {
            $kat_mp[] = $kategoria->id;
        }
        kint::dump($kat_mp);
        View::make('muistiinpano/edit.html', array('muistiinpano' => $muistiinpano, 'kategoriat' => $kategoriat, 'kat_mp' => $kat_mp));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'kesken' => $params['kesken'],
            'prioriteetti' => $params['prioriteetti'],
            'kategoria_id' => $params['kategoria_id'],
            'kuvaus' => $params['kuvaus']
        );

        $muistiinpano = new Muistiinpano($attributes);
        $errors = $muistiinpano->errors();

        if (count($errors) > 0) {
            View::make('muistiinpano/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $muistiinpano->update();

            Redirect::to('/muistipano/' . $muistiinpano->id, array('message' => 'Muistiinpanoa on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {

        $muistiinpano = new Muistiinpano(array('id' => $id));
        $muistiinpano->destroy();
        Redirect::to('/muistilista', array('message' => 'Muistiinpano on poistettu onnistuneesti!'));
    }

}
