<?php   
$auteurs = array(
    array("Nom" => "Harlan Coben", "Livres" => array("Back Spin", "The Final Detail", "Home")),
    array("Nom" => "H.P. Lovecraft", "Livres" => array("L'Appel de Cthulhu", "Le Temple")),
    array("Nom" => "Paulo Coelho", "Livres" => array("L'Alchimiste", "L'Espionne", "Onze minutes"))
);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>P1 sans Ajax</title>
    </head>
    <body>
        <form>
            <label for="auteurs">Auteurs</label>
            <select id="auteurs" name="auteur">
                <?php
                $auteurChoisi = (empty($_GET["auteur"])? 0 : $_GET["auteur"]);
                $i = 0;

                foreach($auteurs as $a)
                {
                    echo "<option value=\"".$i++."\" ".($a["Nom"] === $auteurs[$auteurChoisi]["Nom"] ? " selected" : "").">".$a["Nom"]."</option>";
                }
                ?>
            </select>
            <input type="submit" value="Faire Maj Livres" />
            <label for="livres">Livres</label>
            <select id="livres">
            <?php

                $livresAuteur = $auteurs[$auteurChoisi]["Livres"];

                foreach($livresAuteur as $l)
                {
                    echo "<option>".$l."</option>";
                }

            ?>
            </select>
        </form>
    </body>
</html>


    
