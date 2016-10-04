<?php

class Muistiinpano extends BaseModel {

    public $id, $kayttaja_id, $nimi, $prioriteetti, $kuvaus, $lisatty, $kategoriat;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->tarkistukset = array('validate_nimi_min', 'validate_nimi_max', 'validate_prioriteetti');
    }

    public static function all() {
        $haku = DB::connection()->prepare('SELECT * FROM muistiinpano WHERE kayttaja_id = :kayttaja_id');
        $haku->execute(array('kayttaja_id' => $_SESSION['user']));
        $rivit = $haku->fetchAll();
        $muistiinpanot = array();
        foreach ($rivit as $rivi) {
            $kategoriat = array();
            $kategorianhaku = DB::connection()->prepare('SELECT kategoria.id, kategoria.nimi FROM muistiinpano, kategoria, kat_mp WHERE kat_mp.mp_id = muistiinpano.id AND kat_mp.kategoria_id = kategoria.id AND muistiinpano.id = :id');
            $kategorianhaku->execute(array('id' => $rivi['id']));
            $toisetRivit = $kategorianhaku->fetchAll();
            foreach ($toisetRivit as $toinenRivi) {
                $kategoriat[] = new Kategoria(array(
                    'nimi' => $toinenRivi['nimi'],
                    'id' => $toinenRivi['id']
                ));
            }
            $muistiinpanot[] = new Muistiinpano(array(
                'id' => $rivi['id'],
                'kayttaja_id' => $rivi['kayttaja_id'],
                'nimi' => $rivi['nimi'],
                'prioriteetti' => $rivi['prioriteetti'],
                'kuvaus' => $rivi['kuvaus'],
                'lisatty' => $rivi['lisatty'],
                'kategoriat' => $kategoriat
            ));
            unset($kategoriat);
        }
        return $muistiinpanot;
    }

    public static function find($id) {
        $haku = DB::connection()->prepare('SELECT * FROM muistiinpano WHERE id = :id limit 1');
        $haku->execute(array('id' => $id));
        $rivi = $haku->fetch();
        $kategorianhaku = DB::connection()->prepare('SELECT kategoria.id,kategoria.nimi FROM muistiinpano, kategoria, kat_mp WHERE kat_mp.mp_id = muistiinpano.id AND kat_mp.kategoria_id = kategoria.id AND muistiinpano.id = :id');
        $kategorianhaku->execute(array('id' => $id));
        $toisetRivit = $kategorianhaku->fetchAll();
        $kategoriat = array();
        foreach ($toisetRivit as $toinenRivi) {
            $kategoriat[] = new Kategoria(array(
                'id' => $toinenRivi['id'],
                'nimi' => $toinenRivi['nimi']
            ));
        }
        if ($rivi) {
            $muistiinpano = new Muistiinpano(array(
                'id' => $rivi['id'],
                'kayttaja_id' => $rivi['kayttaja_id'],
                'nimi' => $rivi['nimi'],
                'prioriteetti' => $rivi['prioriteetti'],
                'kuvaus' => $rivi['kuvaus'],
                'lisatty' => $rivi['lisatty'],
                'luokat' => $kategoriat
            ));
        }
        return $muistiinpano;
    }

    public function save() {
        $haku = DB::connection()->prepare('INSERT INTO muistiinpano (kayttaja_id, nimi, prioriteetti, kuvaus, lisatty) VALUES (:kayttaja_id, :nimi, :prioriteetti, :kuvaus, CURDATE()) RETURNING id');
        $haku->execute(array('kayttaja_id' => $_SESSION['user'], 'nimi' => $this->nimi, 'prioriteetti' => $this->prioriteetti, 'kuvaus' => $this->kuvaus));
        $rivi = $haku->fetch();
        $this->id = $rivi['id'];
        foreach ($this->kategoriat as $kategoria) {
            $kategorianhaku = DB::connection()->prepare('INSERT INTO kat_mp (kategoria_id, mp_id) VALUES (:kategoria_id, :mp_id)');
            $kategorianhaku->execute(array('kategoria_id' => $kategoria, 'mp_id' => $this->id));
            $rivi = $haku->fetch();
        }
    }

    public function update() {
        $haku = DB::connection()->prepare('UPDATE muistiinpano SET (nimi, prioriteetti, kuvaus) = (:nimi, :prioriteetti, :kuvaus) WHERE id = :id');
        $haku->execute(array('id' => $this->id, 'nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'prioriteetti' => $this->prioriteetti));
        $rivi = $haku->fetch();
        $poistaKategoriat = DB::connection()->prepare('DELETE FROM kat_mp WHERE muistiinpano_id = :muistiinpano_id');
        $poistaKategoriat->execute(array('muistiinpano_id' => $this->id));
        $rivi = $haku->fetch();
        $kategoriat = $this->kategoriat;
        foreach ($kategoriat as $kategoria) {
            $kategorianhaku = DB::connection()->prepare('INSERT INTO kat_mp (kategoria_id, muistiinpano_id) VALUES (:kategoria_id, :muistiinpano_id)');
            $kategorianhaku->execute(array('kategoria_id' => $kategoria, 'muistiinpano_id' => $this->id));
            $rivi = $haku->fetch();
        }
    }

    public function destroy() {
        $kategorianhaku = DB::connection()->prepare('DELETE FROM kat_mp WHERE muistiinpano_id = :muistiinpano_id');
        $kategorianhaku->execute(array('muistiinpano_id' => $this->id));
        $rivi = $kategorianhaku->fetch();
        $haku = DB::connection()->prepare('DELETE FROM muistiinpano WHERE id = :id');
        $haku->execute(array('id' => $this->id));
        $rivi = $haku->fetch();
    }

    public function validate_nimi_min() {
        $errors = parent::validate_string_length_min($this->nimi, 3, 'Nimen');
        return $errors;
    }

    public function validate_nimi_max() {
        $errors = parent::validate_string_length_min($this->nimi, 75, 'Nimen');
        return $errors;
    }

    public function validate_prioriteetti() {
        $errors = parent::validate_numeric_value($this->prioriteetti, 'Prioriteetin');
        return $errors;
    }

}
