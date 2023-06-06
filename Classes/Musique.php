<?php

class Musique
{
    /*
    public $id_musique;
    public $titre_musique;
    public $lien_musique;
    public $duree_musique;

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
    */

    static function getMusique($id_musique, $id_user=null){
        try {
            $conn = Database::connexionBD();
            $statement = $conn->prepare("SELECT m.id_musique, m.titre_musique, m.lien_musique, m.duree_musique, m.date_parution_musique,
       al.id_album, al.titre_album, al.photo_album, al.id_artiste, ar.pseudo_artiste, s.id_style,s.nom_style
                                    FROM musique m
                                    JOIN album al on m.id_album=al.id_album
                                    JOIN artiste ar on ar.id_artiste=m.id_artiste
                                    JOIN style s on s.id_style=m.id_style
                                    WHERE id_musique=:id_musique");
            $statement->bindParam(':id_musique', $id_musique);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            list($heures, $minutes, $secondes) = explode(":", $result["duree_musique"]);
            $dureeFormatee = sprintf("%02d:%02d", $minutes, $secondes);
            $result["duree_musique"] = $dureeFormatee;
            if (Musique::isFavori($id_user,$result["id_musique"])){
                $result["like"]=true;
            }
            else{
                $result["like"]=false;
            }
            return $result;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    static function getMusiquesBySearch($musique){

        try{

            $conn = Database::connexionBD();
            $statement = $conn->prepare("SELECT id_musique, titre_musique,
                                 lien_musique, duree_musique, ar.id_artiste, pseudo_artiste
                                                FROM musique
                                                JOIN artiste ar using (id_artiste)
                                                WHERE titre_musique ILIKE '%' || :musique || '%'
                                                ORDER BY titre_musique");
            $statement->bindParam(':musique', $musique);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            for ($i=0;$i<count($result);$i++) {
                list($heures, $minutes, $secondes) = explode(":", $result[$i]["duree_musique"]);
                $dureeFormatee = sprintf("%02d:%02d", $minutes, $secondes);
                $result[$i]["duree_musique"] = $dureeFormatee;
            }
            return $result;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }

    }

    static function likeMusic($id_user, $id_musique){
        try {
            $conn = Database::connexionBD();

            $statement = $conn->prepare("SELECT playlist.id_playlist FROM playlist 
                                                    WHERE id_user=:id_user AND titre_playlist='Favoris'");
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();
            $id_playlist=$statement->fetch()[0];
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
        try {
            $conn = Database::connexionBD();
            $statement = $conn->prepare("INSERT INTO musique_playlist(id_musique, id_playlist, date_ajout_musique_playlist) 
                                                VALUES(:id_musique, :id_playlist, NOW())");
            $statement->bindParam(':id_musique', $id_musique);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            return Array($id_musique, $id_playlist);
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    static function unlikeMusic($id_user, $id_musique){
        try {
            $conn = Database::connexionBD();

            $statement = $conn->prepare("SELECT playlist.id_playlist FROM playlist 
                                                    WHERE id_user=:id_user AND titre_playlist='Favoris'");
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();
            $id_playlist=$statement->fetch()[0];
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
        try {
            $conn = Database::connexionBD();

            $statement = $conn->prepare("DELETE FROM musique_playlist 
                                                   WHERE id_playlist=:id_playlist AND id_musique=:id_musique");
            $statement->bindParam(':id_musique', $id_musique);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            return Array($id_musique, $id_playlist);
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    static function isFavori($id_user, $id_musique){
        try {
            $conn = Database::connexionBD();

            $statement = $conn->prepare("SELECT playlist.id_playlist FROM playlist 
                                                    WHERE id_user=:id_user AND titre_playlist='Favoris'");
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();
            $id_playlist=$statement->fetch()[0];
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
        try {
            $conn = Database::connexionBD();
            $statement = $conn->prepare("SELECT id_musique FROM musique_playlist
                                                    WHERE id_musique=:id_musique AND id_playlist=:id_playlist");
            $statement->bindParam(':id_musique', $id_musique);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            $result=$statement->fetch()[0];
            if (empty($result)){
                return false;
            }
            return true;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    static function addInHistorique($id_user, $id_musique){
        try {
            $conn = Database::connexionBD();

            $statement = $conn->prepare("SELECT playlist.id_playlist FROM playlist 
                                                    WHERE id_user=:id_user AND titre_playlist='Historique'");
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();
            $id_playlist=$statement->fetch()[0];
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
        try {
            $conn = Database::connexionBD();
            $statement = $conn->prepare("INSERT INTO musique_playlist(id_musique, id_playlist, date_ajout_musique_playlist) 
                                                VALUES(:id_musique, :id_playlist, NOW())");
            $statement->bindParam(':id_musique', $id_musique);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            return Array($id_musique, $id_playlist);
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }
    
}



?>