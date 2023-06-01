<?php

class Album
{
    public $id_artiste;
    public $nom_artiste;
    public $type_artiste;

    public function __construct($dbRow){
        $this->id_artiste = $dbRow["id_artiste"];
        $this->nom_artiste = $dbRow["nom_artiste"];
        $this->type_artiste = $dbRow["type_artiste"];
    }

}

?>