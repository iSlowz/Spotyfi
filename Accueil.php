<?php
require_once ('Classes/Utilisateur.php');
$id_user = Utilisateur::Connexion()
?>

<!-- /-------------------- HTML --------------------/ -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style/Accueil.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <!-- Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="icon" href="data:,">

    <title>Spotyfi</title>

</head>

<body>
<?php
echo "<div id='id_user' style='display: none'>".$id_user."</div>";

?>
  <div class="disposition">
    
    <div class="Navbar-Accueil">
      <label id="Accueil">Spotyfi++</label>
    </div>

    <div class="Navbar-Recherche">
      <div class="flex-recherche">
        <form class="d-flex" role="search">
          <input class="form-control me-2" id="bar-recherche" type="search" placeholder="Recherche" aria-label="Search">

          <button class="btn btn-outline-success" type="submit" id="bouton-recherche">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
          </button>
          </input>
        </form>
      </div>
      <div class="bouton-user">
        <button class="btn" id="id-bouton-user" type="button"> User
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
          </svg> 
        </button>
      </div>
    </div>

    <div class="Bar-Playlist">
      <div class="flex-playlist">
        <label id="Playlist">Playlists</label>
      </div>
      <div class="bouton-créer">
        <button class="btn" id="id-bouton-créer" type="submit">Créer +</button>
      </div>
    </div>

    <div class="Page-Central">
      <div class="rectangle-page">
        <div class="flex-page">
        </div>
      </div>
    </div>

    <div class="Bar-Footer">
      <div class="musique-info">

      </div>

      <div class="musique-player">
        <audio id="player">
          <source src="musique/epic-power.mp3">
        </audio>

        <div id="musique-player"> 
          <button id="btn-lancer" onClick="lancer()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
            </svg>
          </button> 
          <button id="btn-pause" onClick="pause()">Pause</button> 
          <button id="btn-vol-plus" onClick="volume_plus()">Vol +</button> 
          <button id="btn-vol-moins" onClick="volume_moins()">Vol -</button>
          <progress id="musique-progerss-bar" max="0" value="0"></progress>

          
        </div>
        <div id='player_button'>
          <button id="like" onClick="pause()">like</button> 
          <button id="ajouter" onClick="pause()">ajouter</button> 
        </div>
      </div>
      
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="js/Ajax.js"></script>
  <script src="js/affichage.js"></script>
</body>
</html>
