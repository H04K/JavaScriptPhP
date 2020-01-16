<?php

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
    <title>Affichage sous différentes Formes</title>

    <style>
      td
      {
        border: solid black 1px;
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
                        afficheLivres(xhr.responseXML);
                    }
                    else
                    {
                        alert("[" + xhr.status + "] " + xhr.statusText);
                    }
                }
            });

            xhr.open("POST", "P3AffLivresXML.php");
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("auteur=" + auteurs.options[auteurs.selectedIndex].value);
        }

        function afficheLivres(livresXML)
        {
            var titres = livresXML.getElementsByTagName("TITRE");
            var table = "<table border=\"1\">";
            var select = "<select>";
            var ul = "<ul>";

            document.getElementById("status").textContent = "";

            for (let i = 0; i < titres.length; i++)
            {
                ;
                var ceTitre = titres[i].childNodes[0].nodeValue;

                
                table += "<tr><td>" + ceTitre + "</td></tr>"
             
                select += "<option>" + ceTitre + "</option>";

                ul += "<li>" + ceTitre + "</li>";
            }
            table += "</table>";
            select += "</select>";
            ul += "</ul>";

            document.getElementById("LivresXML").innerHTML = "<p>Tableau :</p>" + table +
            "<p>Liste déroulante :</p>" + select + "<p>Liste simple :</p>" + ul;
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

  <div id="LivresXML">
    
  </div>

  <p id="status"></p>

  <script>
     
    MAJLivres();
  </script>
</body>

</html>
