<?php
require_once('Classes/User.php');
require_once('Classes/Playlist.php');
require_once('Classes/Musique.php');
require_once('Classes/Album.php');
require_once('Classes/Artiste.php');

$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = substr($_SERVER['PATH_INFO'], 1);
$request = explode('/', $request);
$requestRessource = array_shift($request);

$id = array_shift($request);
if ($id == '')
    $id = NULL;
$result = null;

switch ($requestRessource) {
    case 'historique':
        switch ($requestMethod){
            case "GET":
                $result=Playlist::getHistorique($id);
                break;
            case "POST":
                $result=Musique::addInHistorique($id, $_POST["id_musique"]);
                break;
        }
        break;

    case 'playlist_list':
        switch ($requestMethod){
            case "GET":
                $result=User::getPlaylists($id);
                if (isset($_GET["musique"])){
                    //$result = json_decode($_GET["musique"]);
                    $result["musique"]=json_decode($_GET["musique"]);
                }
                break;
            case "POST":
                //$result=Array($id,$_POST["titre"]);
                $result=User::addPlaylist($id,$_POST["titre"]);
                break;
        }
        break;
    case 'playlist':
        switch ($requestMethod){
            case "GET":
                $result=Playlist::getMusiques($id);
                break;
            case "POST":
                //$result=Array($id, $_POST["id_musique"]);
                $result=Playlist::addMusique($id, $_POST["id_musique"]);
                break;
            case "DELETE":
                $result=Playlist::deletePlaylist($id);
                break;

        }
        break;
    case 'musique':
        switch ($requestMethod){
            case "GET":
                //$result=Array($id,$_GET["id_user"]);
                $result=Musique::getMusique($id, $_GET["id_user"]);
                break;
            case "DELETE":

                $id_playlist=explode('.',$id);
                $id_musique=array_shift($id_playlist);
                $id_playlist=array_shift($id_playlist);
                $result=Playlist::deleteMusique($id_musique,$id_playlist);
                break;
        }

        break;
    case 'album':
        switch ($requestMethod){
            case "GET":
                $result=Album::getAlbum($id);
                break;
        }
        break;
    case 'profil':
        switch ($requestMethod){
            case "GET":
                $result=User::getProfil($id);
                break;
            case "PUT":
                parse_str(file_get_contents('php://input'), $_PUT);
                $result=User::modify($id, $_PUT["nom"], $_PUT["prenom"], $_PUT["date"], $_PUT["mail"]);
                break;
        }
        break;
    case 'artiste':
        switch($requestMethod){
            case "GET":
                $result=Artiste::getArtiste($id);
                break;
        }
        break;
    case 'recherche':
        switch ($requestMethod){
            case "GET":
                if (!empty($_GET["recherche"])) {
                    $recherche=$_GET["recherche"];
                    $result["musiques"] = Musique::getMusiquesBySearch($recherche);
                    $result["albums"] = Album::getAlbumBySearch($recherche);
                    $result["artistes"]=Artiste::getArtisteBySearch($recherche);
                    break;
                    }
                break;
        }
        break;
    case 'like':
        switch ($requestMethod){
            case 'POST':

                $result = Musique::likeMusic($_POST["user"], $id);
                break;

            case 'DELETE':
                //$result=Array($_GET["user"], $id);
                $result = Musique::unlikeMusic($_GET["user"], $id);
                break;
        }
        break;
}

if (!empty($result) or $requestRessource=='recherche' or $requestRessource=='historique') {
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('HTTP/1.1 200 OK');
    echo json_encode($result);
    exit();
}

// Bad request case.
header('HTTP/1.1 400 Bad Request');

?>
