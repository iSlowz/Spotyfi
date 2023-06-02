<?php

class Artiste
{
    public $id_artiste;
    public $nom_artiste;
    public $type_artiste;

    public function __construct($dbRow){
        $this->id_artiste = $dbRow["id_artiste"];
        $this->nom_artiste = $dbRow["nom_artiste"];
        $this->type_artiste = $dbRow["type_artiste"];
    }
    
    static function getArtiste($id_artiste){
        try {
            $conn = Database::connexionBD();
            $statement = $conn->prepare("SELECT * FROM artiste WHERE id_artiste=:id_artiste");
            $statement->bindParam(':id_artiste', $id_artiste);
            $statement->execute();
            return $statement->fetch();
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }   

    static function getArtisteBySearch($artiste){

        try{
            $conn = Database::connexionDB();
            $statement = $conn->prepare("SELECT pseudo_artiste, id_artiste FROM artiste WHERE pseudo_artiste ILIKE '%artiste%'");
            $statement->bindParam(':artiste', $artiste);
            $statement->execute();
            return $statement->fetch();
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }

    }

}

?>
