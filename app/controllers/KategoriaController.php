<?php

class KategoriaController extends BaseController {

    public static function index() {
        $kategoriat = Kategoria::all();
        View::make('kategoria/index.html', array('kategoriat' => $kategoriat));
    }

    public static function show($id) {
        $kategoria = Kategoria::find($id);
        View::make('kategoria/show.html', array('kategoria' => $kategoria));
    }

    public static function store() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'kayttaja_id' => $_SESSION['user']
        );
        $kategoria = new Kategoria($attributes);
        $errors = $kategoria->errors();
        if (count($errors) == 0) {
            $kategoria->save();
            Redirect::to('/kategoria/' . $kategoria->id, array('message' => 'Kategoria lisätty!'));
        } else {
            View::make('kategoria/new.html', array('errors' => $errors, 'parameters' => $attributes));
        }
    }

    public static function create() {
        View::make('kategoria/new.html');
    }

    public static function edit($id) {
        $kategoria = Kategoria::find($id);
        View::make('kategoria/edit.html', array('kategoria' => $kategoria));
    }

    public static function update($id) {
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'kayttaja_id' => $_SESSION['user']
        );
        $kategoria = new Kategoria($attributes);
        $errors = $kategoria->errors();
        if (count($errors) == 0) {
            $kategoria->update();
            Redirect::to('/kategoria/' . $kategoria->id, array('message' => 'Kategoria tallennettu!'));
        } else {
            View::make('kategoria/edit.html', array('errors' => $errors, 'kategoria' => $kategoria));
        }
    }

    public static function destroy($id) {
        $kategoria = new Kategoria(array('id' => $id));
        $kategoria->destroy();
        Redirect::to('/kategoria', array('message' => 'Kategoria poistettu!'));
    }

}
