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

    <title>Spotyfi</title>

</head>

<body>
<?php
echo "<div id='id_user' style='display: none'>".$id_user."</div>";

?>
  <div class="disposition">
    
    <div class="Navbar-Accueil">
      <label id="Accueil">Accueil</label>
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
        <button class="btn" id="id-bouton-user" type="submit"> User
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
        <button class="btn" id="playlist-like" type="submit">Like
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
          </svg>
        </button>
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
      <label id="Footer">footer</label>
    </div>

  </div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="js/Ajax.js"></script>
<script src="js/affichage.js"></script>
</body>

<div class="page-playlist-flex">
  <div class="titre">
    <h1>Exemple 1</h1>
    <p class="titre-date">02/06/2023</p>
  </div>
</div>
<div class="page-table">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Titre</th>
        <th scope="col">Artiste</th>
        <th scope="col">Album</th>
        <th scope="col">Date d'ajout</th>
        <th scope="col">Durée</th>
        <th scope="col">Sup</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">music1</th>
        <td>M</td>
        <td>undfined</td>
        <td>2023-06-02</td>
        <td>2:02</td>
        <td>Bouton supprimer</td>
      </tr>
      <tr>
      <th scope="row">music2</th>
        <td>M</td>
        <td>undfined</td>
        <td>2023-06-02</td>
        <td>3:05</td>
        <td>Bouton supprimer</td>
      </tr>
    </tbody>
  </table>
</div>


</html>