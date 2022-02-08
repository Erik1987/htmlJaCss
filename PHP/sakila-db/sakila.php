<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="sakila.php" method="GET">
	<input type="text" name="query" />
	<input type="submit" value="Search" name="search" />
</form>

<form action="sakila.php" method="post">
            <fieldset>
                <legend>Hae genren mukaan</legend>
                <select name="genre">
                    <option value="">Valitse...</option>
                    <option value="action">Action</option>
                    <option value="animation">Animation</option>
                    <option value="children">Children</option>
                </select>
                <input type="submit" name="genrehaku" value="Suorita haku">
                <input type="submit" name="genrehaku" value="Tyhjennä tulokset">
            </fieldset>
        </form>
        <br>
    <form action="sakila.php" method="post">
    <fieldset>
                <legend>Lisää elokuvia tietokantaan</legend>
                <label for="nimi">Nimi</label><br>
                <input type="text" id="nimi" name="nimi"><br>

                <label for="kuvaus">Kuvaus</label><br>
                <input type="text" id="kuvaus" name="kuvaus"><br>

                <label for="vuosi">Julkaisuvuosi</label><br>
                <input type="text" id="vuosi" name="vuosi"><br>

                <label for="kieli">Kieli</label><br>
                <input type="text" id="kieli" name="kieli"><br>

                <label for="vaika">Vuokra-aika</label><br>
                <input type="text" id="vaika" name="vaika"><br>

                <label for="vhinta">Vuokra hinta</label><br>
                <input type="text" id="vhinta" name="vhinta"><br>

                <label for="pituus">Pituus</label><br>
                <input type="text" id="pituus" name="pituus"><br>

                <label for="khinta">Korvaushinta</label><br>
                <input type="text" id="khinta" name="khinta"><br>

                <label for="ika">Ikäraja</label><br>
                <input type="text" id="ika" name="ika"><br>

                <label for="special">Special Features</label><br>
                <input type="text" id="special" name="special"><br>

                <input type="submit" name="lisaa" value="Lisää">
            </fieldset>
</form>
<?php 
if (isset($_GET['search'])) {


function yhteys() {
    $palvelin = "localhost";
    $kayttaja = "root";  // tämä on tietokannan käyttäjä, ei tekemäsi järjestelmän
    $salasana = "";
    $tietokanta = "sakila";
    
    // luo yhteys
    $yhteys = new mysqli($palvelin, $kayttaja, $salasana, $tietokanta);
    
    // jos yhteyden muodostaminen ei onnistunut, keskeytä
    if ($yhteys->connect_error) {
       die("Yhteyden muodostaminen epäonnistui: " . $yhteys->connect_error);
    }
    // aseta merkistökoodaus (muuten ääkköset sekoavat)
    $yhteys->set_charset("utf8");
return $yhteys;
}
$yhteys = yhteys();

$searchItem = $_GET['query']; 
$searchItem = $yhteys->real_escape_string(strip_tags($searchItem));
$query = "SELECT title, description, rating, release_year FROM film WHERE title LIKE '%$searchItem%'";
$tulokset = $yhteys->query($query);
// jos tulosrivejä löytyi
if ($tulokset->num_rows > 0) {
    // hae joka silmukan kierroksella uusi rivi
    while($rivi = $tulokset->fetch_assoc()) {
       // taulukon avaimet (hakasuluissa olevat nimet) ovat TIETOKANNAN KENTTIÄ (sarakkeita)
       echo "Film name: " . $rivi["title"]. "<br>" . $rivi["description"]. "<br>";
       echo "Rating: " .$rivi["rating"] . "<br>Release year: " . $rivi["release_year"] ."<br><br>";
    }
 } else {
    echo "Ei tuloksia";
 }



}
    ?>

<?php
            function yhteys2() {
                $palvelin = "localhost";
                $kayttaja = "root";  // tämä on tietokannan käyttäjä, ei tekemäsi järjestelmän
                $salasana = "";
                $tietokanta = "sakila";
                
                // luo yhteys
                $yhteys = new mysqli($palvelin, $kayttaja, $salasana, $tietokanta);
                
                // jos yhteyden muodostaminen ei onnistunut, keskeytä
                if ($yhteys->connect_error) {
                   die("Yhteyden muodostaminen epäonnistui: " . $yhteys->connect_error);
                }
                // aseta merkistökoodaus (muuten ääkköset sekoavat)
                $yhteys->set_charset("utf8");
            return $yhteys;
            }
            $yhteys = yhteys2();
            // Jos on painettu "Suorita haku", tehdään tietokantahaku ja tulostetaan tulokset.
            // Jos taas on painettu "Tyhjennä tulokset", if-lauseeseen ei mennä, joten
            // tulosalueelle ei tulosteta mitään.
            if (isset($_POST["genrehaku"]) and $_POST['genrehaku']=="Suorita haku"){
                // Jos genre on valittu:
                if ($_POST["genre"] != "") {
                    // muunnetaan syöte tietoturvalliseen muotoon:
                    $hakugenre = $yhteys->real_escape_string(strip_tags($_POST["genre"]));

                    // muodostetaan hakulauseke:
                    $hakulauseke = "SELECT title, description, rating, release_year FROM film
                        INNER JOIN film_category USING (film_id)
                        INNER JOIN category USING (category_id) 
                        WHERE category.name = '$hakugenre'";

                    // tehdään haku ja tallennetaan tulokset muuttujaan:
                    try {$tulokset = $yhteys->query($hakulauseke);}
                    // paitsi jos ei onnistu, tulostetaan virheilmoitus:
                    catch(Exception $voiei){echo "<br>Virhe: " .$voiei->getMessage();}

                    echo "<h3>".ucfirst($_POST["genre"]). "-elokuvia:</h3>";
                    // tulostetaan hakutulokset sivulle:
                    if ($tulokset->num_rows > 0) { // jos tuloksessa on yhtään tietuetta
                        while($rivi = $tulokset->fetch_assoc()) {
                            echo "<span class=tulosnimi>Elokuvan nimi: " . $rivi["title"]. " </span>". 
                                "<br>Kuvaus: " . $rivi["description"].
                                "<br>Ikäraja: " . $rivi["rating"]. 
                                "<br>Julkaisuvuosi: " .$rivi["release_year"].
                                "<br><br>"; // hakasuluissa olevat nimet ovat TIETOKANNAN KENTTIEN nimiä
                        }
                    } // Jos tuloksia ei löytynyt tällä genrellä:
                    else {echo "Ei tuloksia genressä " .$_POST["genre"]. ".<br><br>";}
                } // Jos genreä ei ole valittu:
                else {echo "Valitse genre pudotusvalikosta.<br><br>";}
            }
        ?>

<?php
            function yhteys3() {
                $palvelin = "localhost";
                $kayttaja = "root";  // tämä on tietokannan käyttäjä, ei tekemäsi järjestelmän
                $salasana = "";
                $tietokanta = "sakila";
                
                // luo yhteys
                $yhteys = new mysqli($palvelin, $kayttaja, $salasana, $tietokanta);
                
                // jos yhteyden muodostaminen ei onnistunut, keskeytä
                if ($yhteys->connect_error) {
                   die("Yhteyden muodostaminen epäonnistui: " . $yhteys->connect_error);
                }
                // aseta merkistökoodaus (muuten ääkköset sekoavat)
                $yhteys->set_charset("utf8");
            return $yhteys;
            }
            $yhteys = yhteys3();
            // Jos on painettu "Suorita haku", tehdään tietokantahaku ja tulostetaan tulokset.
            // Jos taas on painettu "Tyhjennä tulokset", if-lauseeseen ei mennä, joten
            // tulosalueelle ei tulosteta mitään.
            if (isset($_POST["lisaa"])){
                // Jos genre on valittu:
                if ($_POST["lisaa"] != "") {
                    // muunnetaan syöte tietoturvalliseen muotoon:
                    $lisaa = $yhteys->real_escape_string(strip_tags($_POST["lisaa"]));
                    $nimi = $_POST['nimi'];
                    $kuvaus = $_POST['kuvaus'];
                    $vuosi = $_POST['vuosi'];
                    $kieli = $_POST['kieli'];
                    $vaika = $_POST['vaika'];
                    $vhinta = $_POST['vhinta'];
                    $pituus = $_POST['pituus'];
                    $khinta = $_POST['khinta'];
                    $ika = $_POST['ika'];
                    $special = $_POST['special'];

                    $query = "INSERT INTO film (title, description, release_year, language_id, rental_duration, 
                    rental_rate, length, replacement_cost, rating, special_features)
                    VALUES ('$nimi', '$kuvaus', '$vuosi', '$kieli', '$vaika', '$vhinta', '$pituus', $khinta, '$ika', '$special')"; 
                    
                    // tehdään haku ja tallennetaan tulokset muuttujaan:
                    try {$tulokset = $yhteys->query($query);
                        echo "Affected rows: " . $yhteys -> affected_rows;
                        
                    }
                    // paitsi jos ei onnistu, tulostetaan virheilmoitus:
                    catch(Exception $voiei){echo "<br>Virhe: " .$voiei->getMessage();}

                    echo "<h3>".ucfirst($_POST["genre"]). "-elokuvia:</h3>";
                    // tulostetaan hakutulokset sivulle:
                    
                } // Jos genreä ei ole valittu:
                else {echo "Valitse genre pudotusvalikosta.<br><br>";}
            }
        ?>

    <?php
        $yhteys->close(); // sivun lopussa aina suljetaan yhteys
    ?>
</body>
</html>