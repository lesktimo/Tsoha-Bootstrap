<?php

class KayttajaController extends BaseController {

    public static function login() {
        View::make('kayttaja/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $kayttaja = Kayttaja::authenticate($params['kayttajatunnus'], $params['salasana']);

        if (!$kayttaja) {
            View::make('kayttaja/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
        } else {
            $_SESSION['user'] = $kayttaja->id;

            Redirect::to('/muistilista');
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function register() {
        View::make('kayttaja/register.html');
    }

    public static function handle_register() {
        $params = $_POST;
        $attributes = array(
            'kayttajatunnus' => $params['kayttajatunnus'],
            'salasana' => $params['salasana']
        );
        if (!$attributes['kayttajatunnus'] || !$attributes['salasana']) {
            View::make('kayttaja/register.html', array('error' => 'Tyhjä käyttäjätunnus tai salasana!'));
        } else {
            $kayttaja = new Kayttaja($attributes);
            $errors = $kayttaja->errors();
            if (count($errors) == 0) {
                $kayttaja->save();
                Redirect::to('/login', array('message' => 'Käyttäjä lisätty onnistuneesti!'));
            } else {
                View::make('kayttaja/register.html', array('errors' => $errors));
            }
        }
    }

}
