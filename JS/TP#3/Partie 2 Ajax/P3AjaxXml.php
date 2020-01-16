<!DOCTYPE html>
<html>
<body>

<h2>The XMLHttpRequest Object</h2>

<p id="demo"></p>

<script>
var xhttp, xmlDoc, txt, x, i;
xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4)
    {
        if (this.status == 200)
        {
            xmlDoc = this.responseXML;
            alert(xmlDoc);
            txt = "";
            x = xmlDoc.getElementsByTagName("ARTIST");
            for (i = 0; i < x.length; i++)
            {
                txt = txt + x[i].childNodes[0].nodeValue + "<br>";
            }
            document.getElementById("demo").innerHTML = txt;
            alert(txt);
        }
        else
        {
            alert("Problème avec la requête : erreur " + this.status);
        }
    }
};
xhttp.open("GET", "cd_catalog.xml", true);
xhttp.send();
</script>

</body>
</html>
