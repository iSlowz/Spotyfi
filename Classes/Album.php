<?php

class Album
{   
    public $id_album;
    public $title_alnum;
    public $photo_album;
    public $date_creation_album;
    public $id_artiste;
    public $id_style;

    public function __construct($dbRow){
        $this->id_album = $dbRow["id_album"];
        $this->title_alnum = $dbRow["title_alnum"];
        $this->photo_album = $dbRow["photo_album"];
        $this->date_creation_album = $dbRow["date_creation_album"];
        $this->id_artiste = $dbRow["id_artiste"];
        $this->id_style = $dbRow["id_style"];
    }

    static function getAlbum($id_album){
        try {
            $conn = Database::connexionBD();
            $statement = $conn->prepare("SELECT id_album, titre_album, photo_album, date_creation_album, id_artiste, id_style
                                    FROM album 
                                    WHERE id_album=:id_album");
            $statement->bindParam(':id_album', $id_album);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }
    
    static function getMusiques($id_album){
        try {
            $conn = Database::connexionBD();
            $result=Array();
            $statement = $conn->prepare("SELECT id_musique, titre_musique, lien_musique, duree_musique, m.id_artiste, pseudo_artiste FROM album a JOIN musique m using (id_album) JOIN artiste ar ON a.id_artiste=ar.id_artiste W
            HERE id_album=:id_artiste;");
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            $result["musiques"] = $statement->fetchAll(PDO::FETCH_ASSOC);

            $statement = $conn->prepare("SELECT titre_playlist, date_creation_playlist FROM playlist WHERE id_playlist=:id_playlist");
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            $result += $statement->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    static function getAlbumBySearch($album){

        try{

            $conn = Database::connexionDB();
            $statement = $conn->prepare("SELECT titre_album FROM album WHERE titre_album ILIKE '%album%'");
            $statement->bindParam(':album', $album);
            $statement->execute();
            return $statement->fetch();
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }

    }

}

?>