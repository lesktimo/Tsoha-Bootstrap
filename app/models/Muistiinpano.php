<?php

class Muistiinpano extends BaseModel {

    public $nimi, $id;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $haku = DB::connection()->prepare('SELECT * FROM Muistiinpano');
        $haku->execute();
        $rivit = $haku->fetchAll();
        $muistiinpanot = array();
        foreach ($rivit as $rivi) {
            $muistiinpanot = new Muistiinpano(array(
                'nimi' => $rivi['nimi'],
                'id' => $rivi['id']
            ));
        }
        return $muistiinpanot;
    }

    public static function find($id) {
        $haku = DB::connection()->prepare('SELECT * FROM Muistiinpano WHERE id = :id LIMIT 1');
        $haku->execute(array('id' => $id));
        $rivi = $haku->fetch();
        if ($rivi) {
            $muistiinpanot = new Muistiinpano(array(
                'nimi' => $rivi['nimi'],
                'id' => $rivi['id']
            ));
            return $muistiinpanot;
        }
        return null;
    }

    function getId() {
        return $this->id;
    }

    function getNimi() {
        return $this->nimi;
    }

}
