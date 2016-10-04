<?php

class Kategoria extends BaseModel {

    public $nimi, $id, $kayttaja_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi_min', 'validate_nimi_max');
    }

    public static function all() {
        $haku = DB::connection()->prepare('SELECT * FROM Kategoria WHERE kayttaja_id = :kayttaja_id');
        $haku->execute(array('kayttaja_id' => $_SESSION['user']));
        $rivit = $haku->fetchAll();
        $kategoriat = array();
        foreach ($rivit as $rivi) {
            $kategoriat[] = new Kategoria(array(
                'nimi' => $rivi['nimi'],
                'id' => $rivi['id'],
                'kayttaja_id' => $rivi['kayttaja_id']
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
                'id' => $rivi['id'],
                'kayttaja_id' => $rivi['kayttaja_id']
            ));
            return $kategoriat;
        }
        return null;
    }

    public function validate_nimi() {
        $errors = parent::validate_string_length_min($this->nimi, 3, 'Nimen');
        return $errors;
    }

    public function validate_nimi_max() {
        $errors = parent::validate_string_length_min($this->nimi, 75, 'Nimen');
        return $errors;
    }

}
