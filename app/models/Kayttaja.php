<?php

class Kayttaja extends BaseModel {

    public $id, $kayttajatunnus, $salasana;

    public function __construct($attributes) {
        parent::__construct($attributes);
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

    function getId() {
        return $this->id;
    }

    function getKayttajatunnus() {
        return $this->kayttajatunnus;
    }

    function getSalasana() {
        return $this->salasana;
    }

    function setSalasana($salasana) {
        $this->salasana = $salasana;
    }

}
