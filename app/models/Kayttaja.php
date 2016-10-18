<?php

class Kayttaja extends BaseModel {

    public $id, $kayttajatunnus, $salasana;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi');
    }

    public static function all() {
        $haku = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $haku->execute();
        $rivit = $haku->fetchAll();
        $kayttajat = array();
        foreach ($rivit as $rivi) {
            $kayttajat = new Kayttaja(array(
                'id' => $rivi['id'],
                'kayttajatunnus' => $rivi['kayttajatunnus'],
                'salasana' => $rivi['salasana']
            ));
        }
        return $kayttajat;
    }

    public static function find($id) {
        $haku = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $haku->execute(array('id' => $id));
        $rivi = $haku->fetch();
        if ($rivi) {
            $kayttaja = new Kayttaja(array(
                'id' => $rivi['id'],
                'kayttajatunnus' => $rivi['kayttajatunnus'],
                'salasana' => $rivi['salasana']
            ));
            return $kayttaja;
        }
        return null;
    }

    public function authenticate($kayttajatunnus, $salasana) {
        $haku = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttajatunnus = :kayttajatunnus AND salasana = :salasana LIMIT 1');
        $haku->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
        $rivi = $haku->fetch();
        if ($rivi) {
            $kayttaja = new Kayttaja(array(
                'id' => $rivi['id'],
                'kayttajatunnus' => $rivi['kayttajatunnus'],
                'salasana' => $rivi['salasana']
            ));
            return $kayttaja;
        } else {
            return null;
        }
    }

    public function save() {
        $haku = DB::connection()->prepare('INSERT INTO Kayttaja (kayttajatunnus, salasana) VALUES (:kayttajatunnus, :salasana) returning id');
        $haku->execute(array('kayttajatunnus' => $this->kayttajatunnus, 'salasana' => $this->salasana));
        $rivi = $haku->fetch();
        $this->id = $rivi['id'];
    }

    public function validate_nimi() {
        $errors = array();
        $haku = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttajatunnus = :kayttajatunnus LIMIT 1');
        $haku->execute(array('kayttajatunnus' => $this->kayttajatunnus));
        $rivi = $haku->fetch();
        if ($rivi) {
            $errors[] = 'Käyttäjätunnus on jo olemassa!';
        }
        return $errors;
    }

}
