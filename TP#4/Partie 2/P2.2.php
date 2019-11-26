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
    <title></title>

    <script type="text/javascript"
src="http://code.jquery.com/jquery-latest.min.js"></script>
  
      <script>
        $(document).ready(MAJLivres);

        function MAJLivres()
        {
            var auteurs = $("#auteurs");

            $("#status").text("Chargement des livres...");

            $.ajax(
            {
                type: "POST",
                url: "./ajaxLivresXML.php",
                dataType: "xml",
                data: "auteur=" + auteurs.prop("options")[auteurs.prop("selectedIndex")].value,
                complete: function(data)
                {
                    afficheLivres(data.responseXML);
                }
            });
        }

        function afficheLivres(livresXML)
        {
            var titres = $(livresXML).find("TITRE");
            var table = "<table border=\"1\">";
            var select = "<select>";
            var ul = "<ul>";

            $("#status").text("");

            titres.each(function()
            {
                
                var ceTitre = $(this).text();

          
                table += "<tr><td>" + ceTitre + "</td></tr>";

               
                select += "<option>" + ceTitre + "</option>";

          
                ul += "<li>" + ceTitre + "</li>";

            });
            table += "</table>";
            select += "</select>";
            ul += "</ul>";

            $("#LivresXML").html("<p>Tableau :</p>" + table + "<p>Liste déroulante :</p>" + select + "<p>Liste simple :</p>" + ul);
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

  <div id="LivresXML"></div>

  <p id="status"></p>
</body>

</html>