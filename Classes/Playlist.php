<?php
class Playlist
{
    public $id_playlist;
    public $titre_playlist;
    public $date_creation_playlist;
    public $id_user;

    public function __construct($dbRow){
        $this->id_playlist = $dbRow["id_playlist"];
        $this->titre_playlist = $dbRow["titre_playlist"];
        $this->date_creation_playlist = $dbRow["date_creation_playlist"];
        $this->id_user = $dbRow["id_user"];
    }
    
}

?>
