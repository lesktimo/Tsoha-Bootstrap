<?php

class Muistiinpano extends BaseModel {

    public $nimi, $id, $prioriteetti, $kategoria_id, $kuvaus, $lisatty, $tila;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_prioriteetti');
    }

    public static function all() {
        $haku = DB::connection()->prepare('SELECT * FROM Muistiinpano');
        $haku->execute();
        $rivit = $haku->fetchAll();
        $muistiinpanot = array();
        foreach ($rivit as $rivi) {
            $muistiinpanot[] = new Muistiinpano(array(
                'nimi' => $rivi['nimi'],
                'id' => $rivi['id'],
                'prioriteetti' => $rivi['prioriteetti'],
                'kategoria_id' => $rivi['kategoria_id'],
                'kuvaus' => $rivi['kuvaus'],
                'lisatty' => $rivi['lisatty'],
                'tila' => $rivi['tila']
            ));
        }
        return $muistiinpanot;
    }

    public static function find($id) {
        $haku = DB::connection()->prepare('SELECT * FROM Muistiinpano WHERE id = :id LIMIT 1');
        $haku->execute(array('id' => $id));
        $rivi = $haku->fetch();
        if ($rivi) {
            $muistiinpano = new Muistiinpano(array(
                'nimi' => $rivi['nimi'],
                'id' => $rivi['id'],
                'prioriteetti' => $rivi['prioriteetti'],
                'kategoria_id' => $rivi['kategoria_id'],
                'kuvaus' => $rivi['kuvaus'],
                'lisatty' => $rivi['lisatty'],
                'tila' => $rivi['tila']
            ));

            return $muistiinpano;
        }
        return null;
    }

    public function save() {

        $haku = DB::connection()->prepare('INSERT INTO Muistiinpano (nimi, prioriteetti, kategoria_id, kuvaus, lisatty) VALUES (:nimi, :prioriteetti, :kategoria_id, :kuvaus, :lisatty) RETURNING id');
        $haku->execute(array('nimi' => $this->nimi, 'prioriteetti' => $this->prioriteetti, 'kategoria_id' => $this->kategoria_id, 'kuvaus' => $this->kuvaus, 'lisatty' => $this->lisatty));
        $row = $haku->fetch();
        $this->id = $row['id'];
    }

    function update($id) {
        $haku = DB::connection()->prepare('UPDATE muistiinpano SET nimi = :nimi, prioriteetti = :prioriteetti, kategoria_id = :kategoria_id, kuvaus = :kuvaus WHERE id = :id');
        $haku->execute(array('nimi' => $this->nimi, 'prioriteetti' => $this->prioriteetti, 'kategoria_id' => $this->kategoria_id, 'kuvaus' => $this->kuvaus, 'lisatty' => $this->lisatty, 'id' => $id));
               
    }
    
    function destroy($id){
        $haku = DB::connection()->prepare('DELETE FROM muistiinpano WHERE muistiinpano.id = :id');
        $haku->execute(array('id' => $id));
                 
    }

    function getId() {
        return $this->id;
    }

    function getNimi() {
        return $this->nimi;
    }

    function getPrioriteetti() {
        return $this->prioriteetti;
    }

    function getKategoria() {
        return $this->kategoria;
    }

    function getKuvaus() {
        return $this->kuvaus;
    }

    function getLisatty() {
        return $this->lisatty;
    }

    function getTila() {
        return $this->tila;
    }

    public function validate_nimi() {

        $tuloste = 'Nimen';
        $errors = array();
        $errors = parent::validate_string_length($this->nimi, 2, $tuloste);

        return $errors;
    }

    public function validate_prioriteetti() {

        $tuloste = 'Prioriteetin';
        $errors = array();
        $errors = parent::validate_numeric_value($this->prioriteetti, $tuloste);

        return $errors;
    }

}
