<?php // Place this code at the top of all pages which you want to protect
session_start();
//if ( ! isset( $_SESSION['isLogged'] ) or "1" != $_SESSION['isLogged'] )
//header('Location: ' . './login.php');?>
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

<title>Neilikka bootstrap</title>
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
  <?php if (isset($_SESSION['isLogged'] ) == true) 
    echo '<a href="logout.php">Logout</a>'
  ?>
<?php include("header.php")?>
    <div id="container-fluid" class="container-fluid p-5 bg-primary text-white text-center">
      <div id="header-container">
        <!--<img src="img/pexels-caio-59599_600.jpg" alt="puutarha" id="header-kuva">-->
        <div id="header-textbox">
            <h2>Meillä voit asioida turvallisesti</h2>
            <p>Laajat ulkotilamme ja suuret myymälä ja kasvihuonetilamme mahdollistavat palvelun normaalisti myös näin korona aikana. Suosittelemme kuitenkin kasvomaskeja käytettäväksi sisätiloissamme. </p>
        </div>
    </div>
      </div>
        
      <div class="container mt-5">
        <div class="row">
         
          <div class="col-sm-4">
            <i class="fab fa-affiliatetheme fa-2x"></i>
            <h3>Asiantuntevuus</h3> <br>
            <img src="http://www.pdphoto.org/images/travels.jpg" alt="Mountains" style="width:100%">
      <div class="kuvaus">Talo</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
          </div>
          <div class="col-sm-4">
            <i class="fab fa-adn fa-2x"></i>
            <h3>Ammattitaito</h3> <br>
            <img src="http://www.pdphoto.org/images/beer.jpg" alt="Forest" style="width:100%">
      <div class="kuvaus">Olut</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
          </div>
          <div class="col-sm-4">
            <i class="fab fa-algolia fa-2x "></i>
            <h3>Valikoima</h3>
            <br>   
            <img src="http://www.pdphoto.org/images/sandiego.jpg" alt="Mountains" style="width:100%">
      <div class="kuvaus">Kaupunki</div>     
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
          </div>
        </div>
      </div>
      <canvas id='canv' width=500 height=200 style="width: 600; height: 600px;"></canvas><script>const canvas = document.getElementById('canv');
        const ctx = canvas.getContext('2d');
        
        const w = canvas.width = document.body.offsetWidth;
        const h = canvas.height = document.body.offsetHeight;
        const cols = Math.floor(w / 20) + 1;
        const ypos = Array(cols).fill(0);
      
        ctx.fillStyle = '#000';
        ctx.fillRect(0, 0, w, h);
        
        function matrix () {
          ctx.fillStyle = '#0001';
          ctx.fillRect(0, 0, w, h);
          
          ctx.fillStyle = '#0f0';
          ctx.font = '15pt monospace';
          
          ypos.forEach((y, ind) => {
            const text = String.fromCharCode(Math.random() * 128);
            const x = ind * 20;
            ctx.fillText(text, x, y);
            if (y > 100 + Math.random() * 10000) ypos[ind] = 0;
            else ypos[ind] = y + 20;
          });
        }
        
        setInterval(matrix, 50);
      </script>
      <?php include("footer.php")?>
</body>


