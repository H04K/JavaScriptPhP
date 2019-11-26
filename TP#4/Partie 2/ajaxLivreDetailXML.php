<?php


header("Content-Type: application/xml; charset=utf-8");


if (!isset($_POST["livre"]))
{
    die("Merci de spécifier le paramètre GET livre avec un valeur correspondant à un entier");
}

$livreChoisi = intval($_POST["livre"]);

try
{
  
    $pdo = new PDO("mysql:host=localhost;dbname=ajax", "root", "");

    $livreChoisiQ = $pdo->prepare("SELECT livre.id, livre.titre, auteur.nom FROM livre INNER JOIN auteur ON auteur.id = livre.idAuteur WHERE livre.id = :livre_choisi;");
    $livreChoisiQ->execute(array(":livre_choisi" => $livreChoisi));
    $livreChoisi = $livreChoisiQ->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e)
{
    die("Impossible de se connecter à la base de données : <br />".$e->getMessage());
}

if (!empty($livreChoisi))
{
    $livreChoisi = $livreChoisi[0];
    echo "<LIVRE><ID>".$livreChoisi["id"]."</ID><TITRE>".$livreChoisi["titre"]."</TITRE><AUTEUR>".$livreChoisi["nom"]."</AUTEUR></LIVRE>";
}

?>