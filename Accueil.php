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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


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
        <button class="btn" id="id-bouton-user" type="button" value="<?php echo $id_user ?>"> User
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
          </svg> 
        </button>
      </div>
    </div>
    <div class="Bar-Playlist">
      <div class="flex-playlist">
      </div>
      <div class="bouton-créer">
        <button class="bouton-créer-style" id="id-bouton-creer">Créer +</button>
      </div>
    </div>
    <div class="Page-Central">
      <div class="rectangle-page">
        <div class="flex-page">
        </div>
      </div>
    </div>

    <div class="Bar-Footer">
      <div class="d-flex flex-footer">
        <div class="p-2 flex-fill musique-info" id="musique-info">
        </div>
        <div class="p-2 flex-fill musique-player">         
          <audio id="player">
          </audio>
          <div class="flex-footer-bouton">
            <div class="flex-footer-bouton-menu">
              <div class="bouton-footer" id="musique-player"> 
                <button class="bouton-menu-footer" id="btn-skip-gauche" onClick="moins5s()">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-skip-backward-fill" viewBox="0 0 16 16">
                    <path d="M.5 3.5A.5.5 0 0 0 0 4v8a.5.5 0 0 0 1 0V8.753l6.267 3.636c.54.313 1.233-.066 1.233-.697v-2.94l6.267 3.636c.54.314 1.233-.065 1.233-.696V4.308c0-.63-.693-1.01-1.233-.696L8.5 7.248v-2.94c0-.63-.692-1.01-1.233-.696L1 7.248V4a.5.5 0 0 0-.5-.5z"/>
                  </svg>
                </button>
                <button class="bouton-menu-footer" id="btn-lancer" onClick='playPause()'>
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
                  </svg>
                </button> 
                <button class="bouton-menu-footer" id="btn-skip-droit" onClick="plus5s()">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-skip-forward-fill" viewBox="0 0 16 16">
                    <path d="M15.5 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V8.753l-6.267 3.636c-.54.313-1.233-.066-1.233-.697v-2.94l-6.267 3.636C.693 12.703 0 12.324 0 11.693V4.308c0-.63.693-1.01 1.233-.696L7.5 7.248v-2.94c0-.63.693-1.01 1.233-.696L15 7.248V4a.5.5 0 0 1 .5-.5z"/>
                  </svg>
                </button>
              </div>
            </div>
            <div class="flex-footer-bar-boucle">
              <input class="slide-style" type="range" id="range-test" value="0" max="0" step="0">
              <button class="bouton-boucle" id="btn-boucle" onClick="boucle()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-repeat" viewBox="0 0 16 16">
                  <path d="M11 4v1.466a.25.25 0 0 0 .41.192l2.36-1.966a.25.25 0 0 0 0-.384l-2.36-1.966a.25.25 0 0 0-.41.192V3H5a5 5 0 0 0-4.48 7.223.5.5 0 0 0 .896-.446A4 4 0 0 1 5 4h6Zm4.48 1.777a.5.5 0 0 0-.896.446A4 4 0 0 1 11 12H5.001v-1.466a.25.25 0 0 0-.41-.192l-2.36 1.966a.25.25 0 0 0 0 .384l2.36 1.966a.25.25 0 0 0 .41-.192V13h6a5 5 0 0 0 4.48-7.223Z"/>
                </svg>
              </button>
            </div>
          </div>
        </div>
        <div class="p-2 flex-fill flex-footer-volume">
          <div>
            <input class="footer-volume-bar" id="volume-bar" type="range" min="0" max="10">
            <div id='logo-volume'></div>
          </div>
        </div>
      </div>
    </div>  
  </div>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="js/Ajax.js"></script>
  <script src="js/affichage.js"></script>
</body>
</html>
