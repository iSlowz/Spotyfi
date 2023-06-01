<?php
require_once('')

$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = substr($_SERVER['PATH_INFO'], 1);
$request = explode('/', $request);
$requestRessource = array_shift($request);

$id = array_shift($request);
if ($id == '')
    $id = NULL;
$result = null;

switch ($requestRessource) {
    case 'musique':
        switch ($requestMethod){
            case "GET":

        }
}

?>
