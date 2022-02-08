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
    
    $linkki = '<a href="nettiteknologia.php?tekno=html">HTML</a>';
    echo "GET: " . var_export($_GET, true) . "<br>";
    echo "POST: " . var_export($_POST, true) . "<br>";
    echo "<br>";
    //$tekno = isset($_GET['tekno']) ? $_GET['tekno'] : "";
    $tekno = $_GET['tekno'] ?? "";
    if ($tekno <> "" and !in_array($tekno, ['html', 'css'])) {
    echo "Haluamaasi teknologiaa ei löydy <br>"; }
    echo "tekno:  $tekno<br>";

        if (isset($_GET['laheta'])) {
            $pakolliset = ['nimi', 'sähköposti', 'salasana'];
            $tyhjat = [];
            foreach ($pakolliset as $pakollinen) {
                if(empty($_GET[$pakollinen])) {
                    $tyhjat[] = $pakollinen;
                }
                if($tyhjat) {}
            }
        }
?>

<form method="GET">

<input name="laheta" type="submit" value="Lähetä">
</form>
</body>
</html>