
<?php
include 'inc/header.php';
Session::CheckLogin();
?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
   $userLog = $users->userLoginAuthotication($_POST);
}
if (isset($userLog)) {
  echo $userLog;
}

$logout = Session::get('logout');
if (isset($logout)) {
  echo $logout;
}



 ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif; width:50%;
    display: block;
    margin-left: 25%;
}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
  border-radius: 5%;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 30%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<h2>Kirjaudu sisään:</h2>

<form action="auth.php" method="post" name="Login-Form">
  <div class="imgcontainer">
    <img src="./images/avatar.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="username"><b>Käyttäjätunnus</b></label>
    <input type="text" placeholder="Syötä käyttäjätunnus"id="username" name="username" required>

    <label for="password"><b>Salasana</b></label>
    <input type="password" placeholder="Syötä salasana" id="password" name="password" required>
        
    <button type="submit" value="Login" name="login">Kirjaudu</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Muista minut
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <a href="neilikka_bootstrap.php" class="cancelbtn" style="text-decoration: none; color: black;">Peruuta</a>
    <!--<button href="neilikka_bootstrap.php" type="button" class="cancelbtn">Peruuta</button> -->
    <span class="password">Unohtuiko <a href="register.php">salasana?</a></span>
  </div>
  <input type="hidden" name="submitted" value="1">
</form>

</body>
</html>