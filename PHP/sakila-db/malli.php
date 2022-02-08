<?php
    $palvelin = "localhost"; // eli oma kone
    $kayttaja = "root";  // löytyy phpMyAdminista Käyttöoikeuksien takaa
    $salasana = "";
    $tietokanta = "sakila";
    $yhteys = new mysqli($palvelin, $kayttaja, $salasana, $tietokanta); // luodaan yhteys

    // jos yhteyden muodostaminen ei onnistunut, keskeytä
    if ($yhteys->connect_error) {
        die("Yhteyden muodostaminen epäonnistui: " . $yhteys->connect_error);
    }
    $yhteys->set_charset("utf8"); // merkistökoodaus (muuten ääkköset sekoavat)
?>

<!DOCTYPE html>
<html lang=fi>

<head>
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sakila-tietokanta</title>
<style>
    body {line-height:1.5;}
    section {margin-top:15px;}
    fieldset {background-color:#FCBCD7;}
    input[type="submit"] {margin-top:5px; padding:3px; font-size:1em; 
        background-color:#FFCEE6; width:130px; border-radius:5px;}
    input[type="submit"]:hover {background-color:#E56AB3;}
    input[type="text"] {width:257px; font-size:1em;}
    input[type="number"] {width:120px; font-size:1em; border-radius:5px; padding-left:5px;}
    select {font-size:1em; padding:3px; width:130px;}
    textarea {width:257px; resize:none;}
    legend {font-size:1.3em;}
    .tulosnimi {background-color:pink; font-weight:500;}
</style>
</head>

<body> 
    <header>
    </header>

    <section>
        <form action="sakila.php" method="post">
            <fieldset>
                <legend>Hae elokuvia</legend>
                <label for="hakuteksti">Kirjoita elokuvan nimi tai osa siitä:</label><br>
                    <input type="text" id="hakuteksti" name="hakuteksti"><br>
                <!-- Molemmat napit antavat value-arvonsa POST-muuttujalle "nimihaku": -->
                <input type="submit" name="nimihaku" value="Suorita haku">
                <input type="submit" name="nimihaku" value="Tyhjennä tulokset">
            </fieldset>
        </form>
        <?php
            // Jos on painettu "Suorita haku", tehdään tietokantahaku ja tulostetaan tulokset.
            // Jos taas on painettu "Tyhjennä tulokset", if-lauseeseen ei mennä, joten
            // tulosalueelle ei tulosteta mitään.
            if (isset($_POST["nimihaku"]) and $_POST['nimihaku']=="Suorita haku"){
                // muunnetaan syöte tietoturvalliseen muotoon:
                $hakuteksti = $yhteys->real_escape_string(strip_tags($_POST["hakuteksti"]));

                // muodostetaan hakulauseke:
                $hakulauseke = "SELECT title, description, rating, release_year FROM film 
                    WHERE title LIKE '%$hakuteksti%'";

                // tehdään haku ja tallennetaan tulokset muuttujaan:
                try {$tulokset = $yhteys->query($hakulauseke);}
                // paitsi jos ei onnistu, tulostetaan virheilmoitus:
                catch(Exception $voiei){echo "<br>Virhe: " .$voiei->getMessage();}

                echo "<h3>Haun tulokset:</h3>"; // tulostetaan hakutulokset sivulle:
                if ($tulokset->num_rows > 0) { // jos tuloksessa on yhtään tietuetta
                    while($rivi = $tulokset->fetch_assoc()) {
                        echo "<span class=tulosnimi>Elokuvan nimi: " . $rivi["title"]. " </span>". 
                            "<br>Kuvaus: " . $rivi["description"].
                            "<br>Ikäraja: " . $rivi["rating"]. 
                            "<br>Julkaisuvuosi: " .$rivi["release_year"].
                            "<br><br>"; // hakasuluissa olevat nimet ovat TIETOKANNAN KENTTIEN nimiä
                    }
                } // jos tuloksessa ei ole tietueita
                else {echo "Ei tuloksia tällä hakusanalla.<br><br>";}
            }
        ?>
    </section>

    <section>
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
        <?php
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
    </section>

    <?php
        $yhteys->close(); // sivun lopussa aina suljetaan yhteys
    ?></p>
</body>   
</html>