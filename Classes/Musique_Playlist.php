<?php
class musique_playlist
{
    public $id_musique;
    public $id_playlist;
    public $date_ajout_musique_playlist;

    public function __construct($dbRow){
        $this->id_musique = $dbRow["id_musique"];
        $this->id_playlist = $dbRow["id_playlist"];
        $this->date_ajout_musique_playlist = $dbRow["date_ajout_musique_playlist"];
    }
}

?>