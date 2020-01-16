<?php
class Voiture {
    public $marque = "ford";
}
$MaVoiture = new Voiture();
$MaVoiture2 = clone $MaVoiture;
$MaVoiture2->marque = 'ferrari';
echo "ma            voiture est une ", $MaVoiture->marque; // affiche "ford
?>