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
    
   
    <link rel="stylesheet" href="style/Sign_up.css">

    <title>Spotyfi</title>

</head>

<body>

<?php
require_once ('Classes/Utilisateur.php');
$result=Utilisateur::sign_up();
var_dump($result);
//print_r($_POST);
?>

  <div class="form">
    
    <nav class="navbar">
      <div class="container-fluid align-content-center justify-content-center">
      <a>Spotyfi++</a>
      </div>
    </nav>

    <div class="rectangle-Sign_up">

      <div class="login-form">
        <form action="#" method="post" class="g-3" id="LoginForm">
          <div class="mb-3">

            <table width="100%" cellspacing="0" cellpadding="5">
              <tr>
                <td colspan="2"><label class="trait">Sign up</label></td>
              </tr>
              
              <tr>
                <td>
                  <div class="texte-gauche">
                    <label for="userInput" class="form-label">Nom :</label>
                    <input type="text" class="form-control" id="userInput" aria-describedby="userInput" name="nom">
                      <?php
                      if (isset($result["nom"])){
                          echo "<p id='erreur'>Veuillez rentrer votre nom</p>";
                      }
                      ?>

                    <label for="userInput" class="form-label">Prénom :</label>
                    <input type="text" class="form-control" id="userInput" aria-describedby="userInput" name="prenom">
                      <?php
                      if (isset($result["prenom"])){
                          echo "<p id='erreur'>Veuillez rentrer votre prénom</p>";
                      }
                      ?>
                    
                    <label for="userInput" class="form-label">Age :</label>
                    <input type="text" class="form-control" id="userInput" aria-describedby="userInput" name="age">
                      <?php
                      if (isset($result["age"])){
                          echo "<p id='erreur'>Veuillez rentrer votre âge</p>";
                      }
                      ?>
                  </div>
                </td>
                
                <td>
                  <div class="texte-droit">
                    <label for="userInput" class="form-label">Email :</label>
                    <input type="text" class="form-control" id="userInput" aria-describedby="userInput" name="mail">
                      <?php
                      if (isset($result["mail"])){
                          echo "<p id='erreur'>Veuillez rentrer votre Email</p>";
                      }
                      ?>

                    <label for="userInput" class="form-label">Mot de passe :</label>
                    <input type="text" class="form-control" id="userInput" aria-describedby="userInput" name="password">
                      <?php
                      if (isset($result["password"])){
                          echo "<p id='erreur'>Veuillez rentrer votre mot de passe</p>";
                      }
                      ?>
                    
                    <label for="userInput" class="form-label">Vérification mot de passe :</label>
                    <input type="text" class="form-control" id="userInput" aria-describedby="userInput" name="verif_password">
                      <?php
                      if (isset($result["verif"])){
                          echo "<p id='erreur'>Veuillez rentrer le même mot de passe</p>";
                      }
                      ?>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <button type="submit" class="btn">S'inscrire</button>
            <?php
            if ($result=="Adresse déjà utilisée !"){
                echo "<p id='erreur'>Adresse déjà utilisée !</p>";
            }
            ?>
        </form>
      </div>
    </div>
  </div>
</body>
</html>