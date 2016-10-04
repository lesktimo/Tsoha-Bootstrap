<?php

class BaseModel {

    protected $validators;

    public function __construct($attributes = null) {
        foreach ($attributes as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        $errors = array();
        foreach ($this->validators as $validator) {
            $errors = array_merge($errors, $this->{$validator}());
        }
        return $errors;
    }

    public function validate_string_length_min($merkkijono, $pituus, $tuloste) {
        $errors = array();
        if ($merkkijono == '' || $merkkijono == null) {
            $errors[] = $tuloste . ' pituuden tulee olla vähintään' . $pituus . 'merkkiä! Se ei saa olla tyhjä!';
        }
        if (strlen($merkkijono) < $pituus) {
            $errors[] = $tuloste . ' pituuden tulee olla vähintään ' . $pituus . ' merkkiä!';
        }
        return $errors;
    }

    public function validate_string_length_max($merkkijono, $pituus, $tuloste) {
        $errors = array();
        if (strlen($merkkijono) > $pituus) {
            $errors[] = $tuloste . ' pituuden saa olla enintään ' . $pituus . ' merkkiä!';
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
