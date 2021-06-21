<?php

class person {
    public function __construct($fornavn, $efternavn, $postnummer, $bydel, $adresse, $stilling, $erfaring, $firma, $løn) {
        $this->fornavn = $fornavn;
        $this->efternavn = $efternavn;
        $this->postnummer = intval($postnummer);
        $this->bydel = $bydel;
        $this->dato = date("Y/m/d");
        $this->adresse = $adresse;
        $this->stilling = $stilling;
        $this->ansættelsesdato = date("Y/m/d");
        $this->erfaring = $erfaring;
        $this->firma = $firma;
        $this->løn = floatval($løn);
    }

    function createuser($db) {

        echo $this->fornavn;

        $personalequery = "INSERT INTO personale (Fornavn, Efternavn, Postnummer, Bydel, Dato, Adresse, Stilling) VALUES ('$this->fornavn', '$this->efternavn', '$this->postnummer', '$this->bydel', '$this->dato', '$this->adresse', '$this->stilling')";
        $ansettelsequery = "INSERT INTO ansættelse (Adresse, Ansettelsesdato, Erfaring) VALUES ('$this->adresse', '$this->ansættelsesdato', '$this->erfaring')";
        $stillingquery = "INSERT INTO stillinginfo (Adresse, Firma, Lon) VALUES ('$this->adresse', '$this->firma', '$this->løn')";

        $db->prepare($personalequery)->execute();
        $db->prepare($ansettelsequery)->execute();
        $db->prepare($stillingquery)->execute();

    }
}

?>

