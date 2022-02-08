<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    
    

$palvelin = "localhost";
$kayttaja = "root";  // tämä on tietokannan käyttäjä, ei tekemäsi järjestelmän
$salasana = "";
$tietokanta = "autokanta";

// luo yhteys
$yhteys = new mysqli($palvelin, $kayttaja, $salasana, $tietokanta);

// jos yhteyden muodostaminen ei onnistunut, keskeytä
if ($yhteys->connect_error) {
   die("Yhteyden muodostaminen epäonnistui: " . $yhteys->connect_error);
}
// aseta merkistökoodaus (muuten ääkköset sekoavat)
$yhteys->set_charset("utf8");

$nimi = $yhteys->real_escape_string(strip_tags($_POST["nimi"] ?? ""));

$query = "SELECT * FROM auto";
$tulokset = $yhteys->query($query);

// jos tulosrivejä löytyi
if ($tulokset->num_rows > 0) {
   // hae joka silmukan kierroksella uusi rivi
   while($rivi = $tulokset->fetch_assoc()) {
      // taulukon avaimet (hakasuluissa olevat nimet) ovat TIETOKANNAN KENTTIÄ (sarakkeita)
      echo "Rekisterinumero: " . $rivi["rekisterinro"]. " - Väri: " . $rivi["vari"]. "<br>";
   }
} else {
   echo "Ei tuloksia";
}

$query = "UPDATE auto SET vari = 'punainen' WHERE rekisterinro = 'CES-528'";

$tulos = $yhteys->query($query);



//$muuttui = $yhteys->affected_rows;
$query = "INSERT INTO auto (rekisterinro, vuosimalli, vari, omistaja) 
VALUES ('CES-123', '2014', 'punainen', '120760-093B')";

$tulos = $yhteys->query($query);

if ($tulos === TRUE) {
    echo "Auto lisätty.";
 } 


$query = "DELETE FROM sakko WHERE auto = 'DAU-781'";

$tulos = $yhteys->query($query);

if ($tulos === TRUE) {
    echo "Auto lisätty.";
 } 

$query = "INSERT INTO sakko ( auto, henkilo, pvm, summa, syy) 
VALUES ('CES-123', '120760-093B', '2022-02-01', '100', 'Nukkuminen autossa')";

$tulos = $yhteys->query($query);

if ($tulos === TRUE) {
    echo "Auto lisätty.";
 }else {echo "ei onnistu perkele";}

$query = "SELECT * FROM henkilo WHERE nimi='$nimi'";
$tulos = $yhteys->query($query);

$yhteys->close();
    ?>
</body>
</html>