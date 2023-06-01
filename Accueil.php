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

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style/Accueil.css">

    <title>Spotyfi</title>

</head>

<body>

  <div class="disposition">
    
    <div class="Navbar-Accueil">
      <label id="Accueil">Accueil</label>
    </div>

    <div class="Navbar-Recherche">
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Search" id="bar-recherche">

        <!-- Bouton de recherche trouvé sur bootstrap -->

        <button class="btn btn-outline-success" type="submit" id="bouton-recherche">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg>
        </button>
      </form>
    </div>

    <div class="Bar-Playlist">
      <label id="Playlist">Playlists</label>
    </div>

    <div class="Page-Central">
      <label id="Page">Page</label>
    </div>

    <div class="Bar-Footer">
      <label id="Footer">footer</label>
    </div>

  </div>
  
</body>

</html>