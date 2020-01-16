<?php

$auteurChoisi = (empty($_GET["auteur"]) ? 0 : $_GET["auteur"]);
//utilisation de Try Catch avec un nouvel objet (PDO)
try
{
    
    $pdo = new PDO("mysql:host=localhost;dbname=ajax", "root", "");

    $livresChoisisQ = $pdo->prepare("SELECT titre FROM livre INNER JOIN auteur ON auteur.id = idAuteur AND auteur.id = :auteur_choisi;");
    $livresChoisisQ->execute(array(":auteur_choisi" => $auteurChoisi));
    $livresChoisis = $livresChoisisQ->fetchAll(PDO::FETCH_ASSOC);

    $auteursQ = $pdo->prepare("SELECT id, nom FROM auteur;");
    $auteursQ->execute();
    $auteurs = $auteursQ->fetchAll(PDO::FETCH_ASSOC);

}
catch (PDOException $e)
{
    die("Impossible de se connecter à la base de données : <br />".$e->getMessage());
}

?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8" />
  <title>Select Option avec BDD</title>
</head>

<body>
  <form>
    <label for="auteurs">Auteur</label>
    <select id="auteurs" name="auteur">
        <?php

        $auteurChoisi = (empty($_GET["auteur"]) ? 0 : $_GET["auteur"]);

        foreach($auteurs as $a)
        {
            echo "<option value=\"".$a["id"]."\" ".($a["nom"] === $auteurs[$auteurChoisi - 1]["nom"] ? " selected" : "").">".$a["nom"]."</option>";
        }
        ?>
    </select>

    <input type="submit" value="Mettre à jour les livres" />

    <label for="livres">Livres</label>
    <select id="livres">
        <?php

        foreach($livresChoisis as $l)
        {
            echo "<option>".$l["titre"]."</option>";
        }

        ?>
    </select>
  </form>
</body>

</html>
