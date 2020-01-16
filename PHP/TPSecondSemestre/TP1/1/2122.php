<?php
class MaClasse
{
    private $attributs = [];
    private $unAutreAtribut;
   

    public function __set($nom,$valeur)
    {
        $this->attributs[$nom] = $valeur;
        echo 'Attribution a  ', $nom , ' la valeur ', $valeur, '<br>';
    }
    public function __get($nom)
    {
        if (isset($this->attributs[$nom]))
        {
            return $this->attributs[$nom];
        }
    }

   
    public function __construct()
    {
        echo 'Construction de la Classe MaClasse</br>';

    }
    public function __destruct()
    {
        echo 'Destruction de MaClasse</br>';
    }

    
}

$obj = new MaClasse;
$obj->attribut = 'SimpleTest';
$obj->unAutreAttribut = 100000000;





?>