<?php

class Muistilista extends BaseModel {

    public $kayttaja_id, $mp_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $haku = DB::connection()->prepare('SELECT * FROM Muistilista');
        $haku->execute();
        $rivit = $haku->fetchAll();
        $muistilistat = array();
        foreach ($rivit as $rivi) {
            $muistilistat = new Muistilista(array(
                'kayttaja_id' => $rivi['kayttaja_id'],
                'mp_id' => $rivi['mp_id']
            ));
        }
        return $muistilistat;
    }

    public static function findKayttajalla($kayttaja_id) {
        $haku = DB::connection()->prepare('SELECT * FROM Muistilista WHERE kayttaja_id = :kayttaja_id LIMIT 1');
        $haku->execute(array('kayttaja_id' => $kayttaja_id));
        $rivi = $haku->fetch();
        if ($rivi) {
            $muistilista = new Muistilista(array(
                'kayttaja_id' => $rivi['kayttaja_id'],
                'mp_id' => $rivi['mp_id']
            ));
            return $muistilista;
        }
        return null;
    }

    function getKayttaja_id() {
        return $this->kayttaja_id;
    }

    function getMp_id() {
        return $this->mp_id;
    }

}
