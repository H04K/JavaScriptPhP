<?php

class Pneu
{
    private $pression;

    function gonfler()
    {
        $pression++;
    }
    function degonfler()
    {
        $pression--;
    }

}

class Roue
{
    private $diametre;
    private $pneu;

    function __construct()
    {
        $this->pneu = new Pneu();
    }
}
class Portiere
{
}
class Moteur
{

}
class Voiture
{
    public $roueAVG, $roueAVD, $roueARG, $roueARD, $roueSecours;
    public $portiereG, $portiereD;

    public $moteur;

    function __construct() {      
        $this->roueAVG = new Roue();      
        $this->roueAVD = new Roue();      
        $this->roueARG = new Roue();      
        $this->roueARD = new Roue();      
        $this->roueSecours = new Roue();      
        $this->portiereG = new Portiere();      
        $this->portiereD = new Portiere();      
        $this->moteur = new Moteur(); 
    }
  
}

$v = new Voiture();
print_r($v);

?>