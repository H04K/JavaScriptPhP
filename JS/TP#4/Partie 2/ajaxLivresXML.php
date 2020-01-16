<?php


header("Content-Type: application/xml; charset=utf-8");


if (empty($_POST["auteur"]))
{
    die("Merci de spécifier le paramètre GET auteur avec un valeur correspondant à un entier");
}

$auteurChoisi = intval($_POST["auteur"]);

try
{
  
    $pdo = new PDO("mysql:host=localhost;dbname=ajax", "root", "");

    $livresChoisisQ = $pdo->prepare("SELECT livre.titre, livre.id FROM livre INNER JOIN auteur ON auteur.id = idAuteur AND auteur.id = :auteur_choisi;");
    $livresChoisisQ->execute(array(":auteur_choisi" => $auteurChoisi));
    $livresChoisis = $livresChoisisQ->fetchAll(PDO::FETCH_NUM);
}
catch (PDOException $e)
{
    die("Impossible de se connecter à la base de données : <br />".$e->getMessage());
}


$listeLivresXML = "<BIBLIOTHEQUE>";
foreach ($livresChoisis as $l)
{
    $listeLivresXML .= "<LIVRE><TITRE>".$l[0]."</TITRE><ID>".$l[1]."</ID></LIVRE>";
}
$listeLivresXML .= "</BIBLIOTHEQUE>";

echo $listeLivresXML;

?>
