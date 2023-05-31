<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <!-- Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <!-- Custom CSS -->
    
   
    <link rel="stylesheet" href="style/Login.css">

    <title>Spotyfi : Sign up</title>

</head>

<body>
<?php
require_once ('Classes/Utilisateur.php');
$a=Utilisateur::Connexion();
var_dump($a);
print_r($_POST);
?>

  <div class="form">
    <nav class="navbar">
      <div class="container-fluid align-content-center justify-content-center">
      <a>Spotyfi++</a>
      </div>
    </nav>

    <div class="rectangle-login">
      <label class="trait">Login</label>

      <div class="login-form">
        <form action="#" method="post" class="g-3" id="LoginForm">
          
          <div class="mb-3">
            <div class="texte-email">
              <label for="userInput" class="form-label">Email :</label>
              <input type="text" class="form-control" id="mail" aria-describedby="userInput" name="mail">
            </div>
          </div>

          <div class="mb-3">
            <div class="texte-mdp">
              <label for="passwordInput" class="form-label">Mot de passe :</label>
              <input type="password" class="form-control" id="passwordInput" name="password">
            </div>
          </div>

            <a href="Register.php"><button type="button" class="btn">Créer compte</button></a>
          <button type="submit" class="btn">Se connecter</button>
          
        </form>
      </div>
    </div>
  </div>

</body>
</html>

