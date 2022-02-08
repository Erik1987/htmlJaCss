<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<title>tehtävä1</title>
</head>
<style>
          body {display: flex; min-height: 100vh; flex-direction: column;}
#container-fluid {background-image: url(./images/pexels-garden.jpg); width: 100%; height: 400px; background-repeat: no-repeat;
  background-size: 100%;}
  #navbar img {width:10%;height: fit-content;}
  #navbar p {text-align: center; color: rgb(247, 247, 247);}
  #header-textbox {
    height: 280px;
    max-width: 350px;
    background-color: rgba(255,255,255,0.4);
    padding: 15px;
}

#header-textbox h2, #header-textbox p {
    padding: 5px;
    color: black;
}
#footer {flex:1;}
</style>
</head>
<body>

 
      <?php 
      echo "Hello world";
      ?>

 <br>
 
 <ul> <h2>Ohjelmointikielet</h2>
<li><?php $php = "PHP"; 
      echo $php;?></li>
      <li><?php $java = "Java"; 
      echo $java;?></li>
      <li><?php $perl = "Perl"; 
      echo $perl;?></li>
      <li><?php $jscript = "Javascript"; 
      echo $jscript;?></li>
</ul>

<br>

<?php 

$luku1 = 1;
$luku2 = 2;
$summa = $luku1 + $luku2;
echo "{$luku1} + {$luku2} = {$summa} <br>";
"<br>";
$luku = rand(1, 10);
echo $luku . "<br>";
if ($luku <= 5) {
  echo "Pieni <br>";
}else {
  echo "Suuri <br>";
}
$i = 0;
while($i <= 3) {
  echo "Erik <br>";
  $i++;
}
$a = 1;
while($a <= 10) {
  if ($a <= 9) {
  echo "{$a}-";
  $a++;
  }else {
    echo "{$a} <br>";
    $a++;
  }
  }
  echo "<table style='border-collapse: collapse;' border:1px;>";
	for ($row=1; $row <= 10; $row++) { 
		echo "<tr> \n";
		for ($col=1; $col <= 10; $col++) { 
		   $p = $col * $row;
		   echo "<td>$p</td> \n";
		   	}
	  	    echo "</tr>";
		}
		echo "</table>";
?>
</body>


