<?php

function tulostasessio() {
    echo "Session-parametrit: <br>";

}

function nayta($kentta) {
    echo $_POST[$kentta] ?? "";
    return;
}
if (!session_id()) session_start(); 

$_POST = array_map('strip_tags', $_POST);
if (isset($_GET['laheta'])){
$pakolliset = ['avain','arvo'];
$tyhjat = [];
foreach ($pakolliset as $pakollinen){
  if (empty($_POST[$pakollinen])) $tyhjat[] = $pakollinen;	
  
  }
 
if ($tyhjat) {
  foreach ($tyhjat as $tyhja){
    echo "$tyhja puuttuu<br>";	
    }
  }
  
else {
     $_SESSION['avain'] = $_POST['avain'];
 
  }
}
tulostasessio();

/* if (!session_id()) session_start();
$avain = "";
$arvo = "";
if(isset($_POST["laheta"])){
    $avain = $_POST["avain"];
    $arvo = $_POST["arvo"];
    $_SESSION['avain'] = $avain;
    $_SESSION['arvo'] = $arvo;
}
if(isset($_POST["override"])){
    $_SESSION['avain'] = $_POST["avain"];
    $_SESSION['arvo'] = $_POST["arvo"];
}
header('location: sess.php');
?> main.php */

/* <?php
if (!session_id()) session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lomake</title>
<link rel="stylesheet" href="site.css">
<style>
</style>
</head>
<body>
<div id="root">
<form method="POST" action="etusivu.php">
    <input type="text" name="avain"><br>
    <input type="text" name="arvo">
    <input type="submit" name="laheta" value="Lähetä">
    <input type="submit" name="override" value="Override">
</form>
<?php
echo $_SESSION['avain']."<br>";
echo $_SESSION['arvo'];
?>
</div>
</body>
</html> */
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sessiot</title>
<link rel="stylesheet" href="site.css">
<style>
    label {display:inline-block; width: 100px;}
</style>
</head>
<body>
<div id="root">
<form method="post">
<label for="nimi">Avain:</label><br>
<input type="text" name="avain" value="<?php nayta('avain');?>"><br>
<label for="arvo">Arvo:</label><br>
<input type="text" name="arvo" value="<?php nayta('arvo');?>"><br>
<input type="submit" name="laheta" value="Lähetä">
</form>

</div>
</body>
</html>