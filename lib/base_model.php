<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon

            $validator_errors = $this->{$validator}();
            $errors = array_merge($errors, $validator_errors);
        }

        return $errors;
    }

    public function validate_string_length($merkkijono, $pituus, $tuloste) {
        $errors = array();
        if ($merkkijono == '' || $merkkijono == null) {
            $errors[] = $tuloste . ' pituuden tulee olla vähintään' . $pituus . 'merkkiä! Se ei saa olla tyhjä!';
        }
        if (strlen($merkkijono) < $pituus) {
            $errors[] = $tuloste . ' pituuden tulee olla vähintään ' . $pituus . ' merkkiä!';
        }

        return $errors;
    }

    public function validate_numeric_value($numero, $tuloste) {
        $errors = array();
        if (is_numeric($numero) == false) {
            $errors[] = $tuloste . ' tulee olla numero!';
        }
        if ($numero < 1 || $numero > 5) {
            $errors[] = $tuloste . ' tulee olla lukujen 1 ja 5 väliltä!';
        }
        return $errors;
    }

}
