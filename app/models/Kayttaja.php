<?php

class Kayttaja extends BaseModel {

    public $id, $kayttajanimi, $salasana;

    public function __construct($id, $kayttajanimi, $salasana) {
        $this->id = $id;
        $this->kayttajanimi = $kayttajanimi;
        $this->salasana = $salasana;
    }
    
    function getId() {
        return $this->id;
    }

    function getKayttajanimi() {
        return $this->kayttajanimi;
    }

    function getSalasana() {
        return $this->salasana;
    }

    function setSalasana($salasana) {
        $this->salasana = $salasana;
    }

}
