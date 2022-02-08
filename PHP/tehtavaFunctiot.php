<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
    function tulostaTyylit() {
        echo "<style>
        .valkoinen {background-color: white; width: 30px; height: 30px;}
        .musta {background-color: black; width: 30px; height: 30px;}
        table {border: 1px solid black; border-collapse: collapse;}
        </style>";
    }
    tulostaTyylit();
    ?>
</head>
<body>
    
    <?php 
    function tervehdi($nimi) {
        echo "Hei, $nimi";
    }
    tervehdi("Jaakko");


    function shakkilauta() {
        echo "<table>";
        for($row=1;$row<=8;$row++) {
          echo "<tr>";
          for($col=1;$col<=8;$col++) {
            $total=$row+$col;
            if($total%2==0) echo "<td class='valkoinen'>";
            else echo "<td class='musta'>";   
            }
        echo "</tr>";
        }
        echo "</table>";
    }
    shakkilauta();
    ?>
   
</body>
</html>