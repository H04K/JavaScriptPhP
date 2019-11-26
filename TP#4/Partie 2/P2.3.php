<?php

try
{
    // Objet de connexion à la BDD
    $pdo = new PDO("mysql:host=localhost;dbname=ajax", "root", "");

    $listeLivresQ = $pdo->prepare("SELECT id, titre FROM livre;");
    $listeLivresQ->execute();
    $listeLivres = $listeLivresQ->fetchAll(PDO::FETCH_NUM);
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
    <title>2.3 : AJAX et jQuery</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"> </script>
    <script>
       
        $(document).ready(MAJLivre);

        function MAJLivre()
        {
            var livres = $("#livres");

            $("#status").text("Chargement des détails des livres...");

            $.ajax(
            {
                type: "POST",
                url: "ajaxLivreDetailXML.php",
                dataType: "xml",
                data: "livre=" + livres.prop("options")[livres.prop("selectedIndex")].value,
                complete: function(data)
                {
                    afficheDetails(data.responseXML);
                }
            });
        }

        function afficheDetails(detailsXML)
        {
            const infos = [ "ID", "TITRE", "AUTEUR" ];
            var details = $(detailsXML);
            var firstPart = "<tr>", secondPart = "<tr>";

            $("#status").text("");

            $(infos).each(function()
            {
                firstPart += "<th>" + this + "</th>";
                secondPart += "<td>" + details.find(this.valueOf()).text() + "</td>";
            });

            $("#detailsXML").html(firstPart + "</tr>" + secondPart + "</tr></table>");
        }
    </script>
</head>

<body>
  <label for="livres">Livre :</label>
  <select id="livres" onchange="MAJLivre();">
      <?php

      foreach ($listeLivres as $l)
      {
          echo "<option value=\"".$l[0]."\">".$l[1]."</option>";
      }

      ?>
  </select>

  <br /><br /><table id="detailsXML" border="1"></table>

  <p id="status"></p>
</body>

</html>