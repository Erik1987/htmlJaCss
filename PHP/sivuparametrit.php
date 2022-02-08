<?php
    // Jos on jo lähetetty jotain arvoja, jätetään ne näkyviin:
    function naytaSyotetty($kentta) {
        isset($_GET['kentta']) ? $_GET['kentta'] : "" ;
    }

    // jos sivulle tullaan lomakkeen lähetyksen jälkeen (eli jos laheta-arvo löytyy):
    if (isset($_GET['lähetä'])) {

        $pakolliset = ["nimi","sähköpostiosoite","salasana"]; // lomakkeen pakolliset kentät
        $tyhjat = []; // ne lomakkeen kentät, joita ei ole täytetty, vaikka pitäisi
       
        foreach ($pakolliset as $pakollinen) {
            if (empty($_GET[$pakollinen])) {$tyhjat[] = $pakollinen;}
        }

        // jos tyhjat-taulukossa on yksikin arvo eli taulukon boolean-arvo on true:
        if ($tyhjat) {
            foreach ($tyhjat as $tyhja) {
                echo ucfirst($tyhja)." puuttuu.<br>";
            }
        }

        // jos kaikki kentät on täytetty:
        else {
            foreach ($_GET as $nimike => $syote) {
                if (!is_array($syote)) {
                    $syote = strip_tags($syote); // tägien poisto, jottei käyttäjä syötä koodia
                    echo "$nimike: $syote<br>";
                }
                else {echo "$nimike: ".implode(", ", $syote)."<br>";}
                // 
            }
        }
    }
?>

<!DOCTYPE html>
<html lang=fi>

<head>
<meta http-equiv="content-type" content="text/html">
<meta charset="utf-8"> <!-- ääkköset -->
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- responsiivisuus -->
<title>Lomakekäsittelijä</title>
<style>
    label {display: inline-block; margin: 15px 0px 5px 0px;}
</style>
</head>

<body> 
    <div>
        <form method="GET">
        <!-- Kun method=GET, lomakkeen name-nimetyt tiedot siirtyvät lähetettäessä osoiteriville. -->
            <fieldset>
                <label for="nimi">Nimi:</label><br>
                    <input type="text" name="nimi" value="<?php naytaSyotetty('nimi')?>"><br>
                <label for="sähköpostiosoite">Sähköpostiosoite:</label><br>
                    <input type="text" name="sähköpostiosoite"
                    value="<?php naytaSyotetty('sähköpostiosoite')?>"><br>
                <label for="salasana">Salasana:</label><br>
                    <input type="password" name="salasana"><br>
                <label for="sukupuoli">Sukupuoli:</label><br>
                    <input type="radio" name="sukupuoli" value="mies">Mies<br>
                    <input type="radio" name="sukupuoli" value="nainen">Nainen<br>
                    <input type="radio" name="sukupuoli" value="nainen">Muu/En halua sanoa<br>
                <label for="maakunta">Maakunta:</label><br>
                    <select name="maakunta">
                        <option value="valitse">Valitse...</option>
                        <option value="ahvenanmaa">Ahvenanmaa</option>
                        <option value="lappi">Lappi</option>
                        <option value="pirkanmaa">Pirkanmaa</option>
                    </select><br>
                <label for="lemmikit[]">Lemmikit:</label><br>
                    <input type="checkbox" name="lemmikit[]" value="koira">Koira<br>
                    <input type="checkbox" name="lemmikit[]" value="kissa">Kissa<br>
                    <input type="checkbox" name="lemmikit[]" value="matelija">Matelija<br>
                    <input type="checkbox" name="lemmikit[]" value="jyrsija">Jyrsijä<br>
                    <input type="checkbox" name="lemmikit[]" value="kala">Kala<br>
                    <input type="checkbox" name="lemmikit[]" value="muu">Muu<br>
                <label for="kuvaus">Kuvaus:</label><br>
                    <textarea rows="5" name="kuvaus" 
                    value="<?php naytaSyotetty('kuvaus')?>"></textarea><br><br>
                <input type="hidden" name="osasto" value="Espoo">
                <input type="submit" name="lähetä" value="Lähetä">
            </fieldset>
        </form>
    </div>

</body>   
</html>