<?php
//utilisation de Try Catch avec un nouvel objet (PDO)
try
{
    
    $pdo = new PDO("mysql:host=localhost;dbname=ajax", "root", "");

    $listeAuteursQ = $pdo->prepare("SELECT id, nom FROM auteur;");
    $listeAuteursQ->execute();
    $listeAuteurs = $listeAuteursQ->fetchAll(PDO::FETCH_NUM);
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
    <title>AJAX P2 - sans XML</title>

    <style>
      #Livres
      {
        display: inline;
      }
    </style>

    <script>
        function getXMLHttpRequest() {
            var request = null;
            try {
                request = new XMLHttpRequest();
            } catch (err1) {
                try {
                    var request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (err2) {
                    try {
                        var request = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (err3) {
                        request = null;
                    }
                }
            }
            return request;
        }

        function MAJLivres()
        {
            var xhr = getXMLHttpRequest();
            var auteurs = document.getElementById("auteurs");

            document.getElementById("status").textContent = "Chargement des livres...";

            xhr.addEventListener("readystatechange", function()
            {
                if (xhr.readyState === 4)
                {
                    if (xhr.status === 200)
                    {
                        afficheLivres(xhr.responseText);
                    }
                    else
                    {
                        alert("[" + xhr.status + "] " + xhr.statusText);
                    }
                }
            });

            xhr.open("POST", "ajaxLivres.php");
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("auteur=" + auteurs.options[auteurs.selectedIndex].value);
        }

        function afficheLivres(livres)
        {
            document.getElementById("Livres").firstElementChild.innerHTML = livres;
            document.getElementById("status").textContent = "";
        }
    </script>
</head>

<body>
  <label for="auteurs">Auteur :</label>
  <select id="auteurs" onchange="MAJLivres();">
      <?php

   
      foreach ($listeAuteurs as $l)
      {
          echo "<option value=\"".$l[0]."\">".$l[1]."</option>";
      }

      ?>
  </select>

  <div id="Livres">
    <select>
    </select>
  </div>

  <p id="status"></p>

  <script>
    MAJLivres();
  </script>
</body>

</html>>
