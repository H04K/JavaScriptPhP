
<?php
class Employe {
    var $nom;
    var $salaire;

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
echo $bob->toHTML();
?>