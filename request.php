<?php
require_once('Classes/User.php');
require_once('Classes/Playlist.php');
require_once('Classes/Musique.php');

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
        }
        break;

    case 'playlist_list':
        switch ($requestMethod){
            case "GET":
                $result=User::getPlaylists($id);
                break;
        }
        break;
    case 'playlist':
        switch ($requestMethod){
            case "GET":
                $result=Playlist::getMusiques($id);
                break;
        }
        break;
    case 'musique':
        switch ($requestMethod){
            case "GET":
                $result=Musique::getMusique($id);
                break;
        }
        break;
}

if (!empty($result)) {
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
