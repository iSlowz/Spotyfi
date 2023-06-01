<?php

class Musique
{
    public $id_musique;
    public $titre_musique;
    public $lien_musique;
    public $duree_musique;
    public $date_parution_musique;
    public $id_artiste;
    public $id_album;
    public $id_style;

    public function __construct($dbRow){
        $this->id_musique = $dbRow["id_musique"];
        $this->titre_musique = $dbRow["titre_musique"];
        $this->lien_musique = $dbRow["lien_musique"];
        $this->duree_musique = $dbRow["duree_musique"];
        $this->date_parution_musique = $dbRow["date_parution_musique"];
        $this->id_artiste = $dbRow["id_artiste"];
        $this->id_album = $dbRow["id_album"];
        $this->id_style = $dbRow["id_style"];
    }
    
}

?>