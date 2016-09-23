<?php

class Kategoria extends BaseModel {

    public $nimi, $id;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $haku = DB::connection()->prepare('SELECT * FROM Kategoria');
        $haku->execute();
        $rivit = $haku->fetchAll();
        $kategoriat = array();
        foreach ($rivit as $rivi) {
            $kategoriat = new Kategoria(array(
                'nimi' => $rivi['nimi'],
                'id' => $rivi['id']
            ));
        }
        return $kategoriat;
    }

    public static function find($id) {
        $haku = DB::connection()->prepare('SELECT * FROM Kategoria WHERE id = :id LIMIT 1');
        $haku->execute(array('id' => $id));
        $rivi = $haku->fetch();
        if ($rivi) {
            $kategoriat = new Kategoria(array(
                'nimi' => $rivi['nimi'],
                'id' => $rivi['id']
            ));
            return $kategoriat;
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
