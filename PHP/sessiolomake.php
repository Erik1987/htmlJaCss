<?php

    // Perustetaan istunto, jos ei vielä ole perustettu.
    if (!session_id()) {session_start();}

    // Jos sivulle tullaan sivun lähetyksen jälkeen eli on painettu Tallenna-nappia:
    if (isset($_POST['tallenna'])) {
    
        $pakolliset = ["avain","arvo"]; // lomakkeen pakolliset kentät
        $tyhjat = []; // ne lomakkeen kentät, joita ei ole täytetty, vaikka pitäisi
    
        foreach ($pakolliset as $pakollinen) {
            if (empty($_POST[$pakollinen])) {$tyhjat[] = $pakollinen;} // listataan tyhjät
            else {$_POST[$pakollinen] = strip_tags($_POST[$pakollinen]);} // poistetaan tägit ei-tyhjistä
        }
        // jos tyhjat-taulukossa on yksikin arvo eli taulukon boolean-arvo on true:
        if ($tyhjat) {
            foreach ($tyhjat as $tyhja) {echo ucfirst($tyhja)." puuttuu.<br>";}
        }
        // jos kaikki kentät on täytetty, tallennetaan avain-arvopari istuntomuuttujiin:
        else {$_SESSION[$_POST["avain"]] = $_POST["arvo"];}
    }

    // Jos on painettu Poista ja lopeta -linkkiä:
    if (isset($_GET['ulos'])) {
        session_unset();
        session_destroy();
        header("location:sessiolomake.php"); // poistetaan GETin ulos-parametri
    }
    // Jos olisi poistoa varten submit-nappi, edellisessä pitäisi if-lauseena olla seuraava:
    // if (isset($_POST['ulos'])) {

    function tulostaParametrit() {
        foreach ($_SESSION as $nimike => $onNyt) {
            echo "$nimike: $onNyt<br>";
        }
    }
?>

<!DOCTYPE html>
<html lang=fi>

<head>
<meta http-equiv="content-type" content="text/html">
<meta charset="utf-8"> <!-- ääkköset -->
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- responsiivisuus -->
<title>Istuntoparametrien käsittelyä</title>
<style>
    label {display: inline-block; margin: 15px 0px 5px 0px;}
</style>
</head>

<body> 
    <div>
        <form method="POST">
            <fieldset>
                <label for="avain">Avain:</label><br>
                    <input type="text" name="avain"><br>
                <label for="arvo">Arvo:</label><br>
                    <input type="text" name="arvo"><br><br>
                <input type="submit" name="tallenna" value="Tallenna arvot">
                <!--input type="submit" name="ulos" value="Poista ja lopeta"-->
                <a href="sessiolomake.php?ulos=k">Poista ja lopeta</a>
            </fieldset>
        </form>
        <?php tulostaParametrit(); ?>
    </div>

</body>   
</html>