<?php

class Artiste
{
    public $id_artiste;
    public $nom_artiste;
    public $prenom_artiste;
    public $type_artiste;
    public $pseudo_artiste;
    public $id_style;


    public function __construct($dbRow){
        $this->id_artiste = $dbRow["id_artiste"];
        $this->nom_artiste = $dbRow["nom_artiste"];
        $this->type_artiste = $dbRow["type_artiste"];
    }
    
    static function getArtiste($id_artiste){
        try {
            $conn = Database::connexionBD();
            $statement = $conn->prepare("SELECT id_artiste, pseudo_artiste, nom_artiste, prenom_artiste, type_artiste, s.id_style, nom_style
                    FROM artiste JOIN style s on artiste.id_style = s.id_style
                    WHERE id_artiste=:id_artiste");
            $statement->bindParam(':id_artiste', $id_artiste);
            $statement->execute();
            $result= $statement->fetch(PDO::FETCH_ASSOC);

            $statement = $conn->prepare("SELECT id_musique,  titre_musique, lien_musique, duree_musique, a.id_album, titre_album FROM musique JOIN album a on musique.id_album = a.id_album WHERE musique.id_artiste=:id_artiste");
            $statement->bindParam(':id_artiste', $id_artiste);
            $statement->execute();
            $result["musiques"] = $statement->fetchAll(PDO::FETCH_ASSOC);
            for ($i=0;$i<count($result["musiques"]);$i++) {
                list($heures, $minutes, $secondes) = explode(":", $result["musiques"][$i]["duree_musique"]);
                $dureeFormatee = sprintf("%02d:%02d", $minutes, $secondes);
                $result["musiques"][$i]["duree_musique"] = $dureeFormatee;
            }

            return $result;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }   

    static function getArtisteBySearch($artiste){

        try{
            $conn = Database::connexionBD();
            $statement = $conn->prepare("SELECT pseudo_artiste, id_artiste, nom_style
                                            FROM artiste JOIN style using(id_style) 
                                            WHERE pseudo_artiste ILIKE '%' || :artiste || '%'
                                                ORDER BY pseudo_artiste");
            $statement->bindParam(':artiste', $artiste);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }

    }

}

?>
