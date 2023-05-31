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

    <title>Spotyfi</title>

    <style>

      .navbar{

        background-color: rgb(2, 97, 103);
        border-bottom: solid white;
        color: white;

        align-items: center;

        font-size: 3.5em;

      }


      .form{

        background-color: rgb(25, 157, 166);
        

      }

      .rectangle-login{
      
        border: rgb(2, 97, 103);
        background-color: rgb(2, 97, 103);

        color: white;

        text-align: center;
        font-size: 2em;

        border-radius: 20px 20px 20px 20px / 20px 20px 20px 20px;

        margin-top: 2em;
        margin-left: 17em;
        margin-right: 17em;
        margin-bottom: 2em;

        padding: 0.2em 3em;
      
      }

      .trait{

        border-bottom : solid white;

        padding-bottom: 0.5em;
        padding-right: 1.5em;
        padding-left: 1.5em;

      }

      .texte-email{

        text-align: left;

        font-size: 0.7em;

        padding-top: 1em;

      }

      .texte-mdp{

        text-align: left;

        font-size: 0.7em;

        padding-top: 0.5em;

      }

      .btn{

        background-color: rgb(25, 157, 166);

        color: white;

        margin-bottom: 1em;
        margin-top: 1em;

        border-radius: 20px 20px 20px 20px / 20px 20px 20px 20px;

      }

    </style>

</head>

<body class="form">

  <nav class="navbar">
    <div class="container-fluid align-content-center justify-content-center">
     <a>Spotyfi++</a>
    </div>
  </nav>

  <div class="rectangle-login">
    <label class="trait">Login</label>

    <div class="login-form">
      <form action="Login.php" method="post" class="g-3" id="LoginForm">
        
        <div class="mb-3">
          <div class="texte-email">
            <label for="userInput" class="form-label">Email :</label>
            <input type="text" class="form-control" id="userInput" aria-describedby="userInput" name="userInput">
          </div>
        </div>

        <div class="mb-3">
          <div class="texte-mdp">
            <label for="passwordInput" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" id="passwordInput" name="password">
          </div>
        </div>

        <button type="button" class="btn">Créer compte</button>
        <button type="button" class="btn">Se connecter</button>
        
      </form>
    </div>
  </div>

</body>
</html>