<?php
class Employe {
    var $nom;
    public $salaire;
    //private $salaire; retourne une erreur impossible d'y accèder

    function __construct($n, $s) {
        $this->nom = $n;
        $this->salaire = $s;
    }

    function toHTML() {
        return "<strong>Le nom:</strong><em>$this->nom</em><br>".
        "<strong>sal:</strong><em>$this->salaire</em>";
    }
}
$bob = new Employe("Bob", 30000);
$bob->salaire = -120000;
echo $bob->toHTML();
?>