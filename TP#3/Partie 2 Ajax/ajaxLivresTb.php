<?php

// Paramètre $_POST["auteur"] : entier qui désigne l'auteur par son id dans la BDD
if (empty($_POST["auteur"]))
{
    die("Merci de spécifier le paramètre POST auteur");
}

$auteurChoisi = intval($_POST["auteur"]);

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

$listeLivres = "";

//rajout des tr td pour afficher le resultat sous forme de tableau
foreach ($livresChoisis as $l)
{
    $listeLivres .= "<tr><td>".$l[0]."</td></tr>";
}


echo $listeLivres;

?>
