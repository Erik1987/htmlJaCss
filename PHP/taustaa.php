<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Web-ohjelmointikurssin aloitus</title>
<link rel="stylesheet" href="site.css">
<style>
</style>
</head>
<body>
<div id="root">

<?php
define('ARVO',5.17);

function summa($luku1, $luku2){ 
echo "globaali:".$GLOBALS['arvo']."<br>";
$ARVO = ARVO;
echo "vakio:$ARVO<br>";
$GLOBALS['arvoII'] = 4.17;
$summa = $luku1 + $luku2;
$miinus = $luku1 - $luku2;
return array($summa,$miinus);
}

$arvo = 3.17;

foreach($_SERVER as $key => $value){
echo "$key:$value<br>";	
}

echo "basename:".basename($_SERVER['SCRIPT_NAME'])."<br>";
$a = 1;
$b = 2;

$tulos = summa($a,$b);
echo "globaaliII:".$GLOBALS['arvoII']."<br>";

$tulos[] = 3;

//2022-01-31 23:59:59
//2022-02-01 00:00:00

$numbers = [1,2];
$scores = [...$numbers, 3, 4];

$v = var_export($scores,true);
$dst = date('I') ? "Kesäaika" : "Talviaika";
echo "$dst<br>";

file_put_contents("testi.txt",date("Y-m-d h:i:s")." ".basename(__FILE__).",v: $v\n", FILE_APPEND);

$t = implode(",",$scores);
// $taulukko = explode(",",$t); 

echo "<p>Taulukko: $t</p>";

?>
</div>
</body>
</html>