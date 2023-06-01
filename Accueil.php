<?php
$fileName = explode('/', $_SERVER['PHP_SELF']);
$fileName = array_pop($fileName);
//echo $fileName;
?>

<!-- /-------------------- HTML --------------------/ -->
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

    <!-- Custom CSS 
  
    <link rel="stylesheet" href="style/Accueil.css">
  
    -->

    <title>Spotyfi</title>

    <!--
    <style>

      html, body {
        
        height: 100%;
      
      }

      .disposition {
        display: grid;
        grid-template-rows: 100px 517px 0px 0px 100px;
        grid-template-columns: repeat(5, 2fr);
        color: darkgreen
      }

      .Navbar-Accueil {
        grid-column: 1;
        grid-row: 1;

        background-color: rgb(2, 97, 103);
        color: white;
        border-bottom : solid white;
        border-right : solid white;

      }

      .Navbar-Recherche {
        grid-column: 2 / 6;
        grid-row: 1;

        background-color: rgb(2, 97, 103);
        color: white;
        border-bottom : solid white;

      }

      .Bar-Playlist{

        grid-column: 1;
        grid-row: 2 / 6;

        background-color: rgb(2, 97, 103);
        color: white;
        border-right : solid white;

      }
      
      .Bar-Footer{

        grid-column: 2 / 6;
        grid-row: 5 / 6;

        background-color: rgb(2, 97, 103);

        color: white;
        border-top : solid white;

      }

      .Page-Central{
  
        grid-column: 2 / 6;
        grid-row: 2 / 5;

        background-color: rgb(25, 157, 166);

        color : white;

      }

    </style>
    -->

    <style>

      html, body{

        height : 100%;

      }

      #bar-haut{
        background-color: rgb(2, 97, 103);
        border-bottom: solid white;
        color: white;

        align-items: center;

        font-size: 3.5em;

      }

      .

    </style>

</head>

<body>

  <div class="d-flex flex-column">
    <div class="d-flex flex-row" id="bar-haut">
      
        <div class="Navbar-Accueil">
          <label>Accueil</label>
        </div>
      
        <div class="Navbar-Recherche">
          <label>Recherche</label>
        </div>
      
    </div>
    <div class="d-flex flex-row">
      
        <div class="Bar-Playlist">
          <label id="Playlist">Playlists</label>
        </div>
      
        <div class="Page-Central">
          <label id="Page">Page</label>
        </div>
      
    </div>
    <div class="d-flex flex-row">
      <label>Flex item 1</label>
        <div class="Bar-Footer">
          <label id="Footer">footer</label>
        </div>
    </div>
  </div>

</body>
</html>