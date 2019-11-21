<?php


if (empty($_POST["auteur"]))
{
    die("Merci de spécifier le paramètre POST auteur avec un valeur correspondant à un entier");
}

$auteurChoisi = intval($_POST["auteur"]);
//utilisation de Try Catch avec un nouvel objet (PDO)
try
{
 
    $pdo = new PDO("mysql:host=localhost;dbname=ajax", "root", "");

    $livresChoisisQ = $pdo->prepare("SELECT titre FROM livre INNER JOIN auteur ON auteur.id = idAuteur AND auteur.id = :auteur_choisi;");
    $livresChoisisQ->execute(array(":auteur_choisi" => $auteurChoisi));
    $livresChoisis = $livresChoisisQ->fetchAll(PDO::FETCH_NUM);
}
catch (PDOException $e)
{
    die("Impossible de se connecter à la base de données : <br />".$e->getMessage());
}

$listeLivres = "<select>";
foreach ($livresChoisis as $l)
{
    $listeLivres .= "<option>".$l[0]."</option>";
}
$listeLivres .= "<select>";


echo $listeLivres;

?>
