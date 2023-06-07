<?php

class Album //classe qui gère les albums de la bdd
{
    /**Récupère les informations et musiques d'un album
     * @param $id_album
     * @return array|false|mixed
     */
    static function getAlbum($id_album){
        try {   //récupère ses musiques
            $result=Array();
            $conn = Database::connexionBD();
            $statement = $conn->prepare("SELECT id_musique,  titre_musique, lien_musique, duree_musique FROM musique JOIN album using (id_album) WHERE id_album=:id_album");
            $statement->bindParam(':id_album', $id_album);
            $statement->execute();
            $result["musiques"] = $statement->fetchAll(PDO::FETCH_ASSOC);

            for ($i=0;$i<count($result["musiques"]);$i++) {
                list($heures, $minutes, $secondes) = explode(":", $result["musiques"][$i]["duree_musique"]);
                $dureeFormatee = sprintf("%02d:%02d", $minutes, $secondes);
                $result["musiques"][$i]["duree_musique"] = $dureeFormatee;
            }

            //récupère ses informations
            $statement = $conn->prepare("SELECT id_album, titre_album, photo_album, date_creation_album, al.id_artiste, al.id_style, ar.pseudo_artiste
                                    FROM album al
                                    JOIN artiste ar using (id_artiste)
                                    WHERE id_album=:id_album");
            $statement->bindParam(':id_album', $id_album);
            $statement->execute();
            $result += $statement->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }
    
    static function getMusiques($id_album){
        try {
            $conn = Database::connexionBD();
            $result=Array();
            $statement = $conn->prepare("SELECT id_musique, titre_musique, lien_musique, duree_musique, m.id_artiste, pseudo_artiste FROM album a JOIN musique m using (id_album) JOIN artiste ar ON a.id_artiste=ar.id_artiste WHERE id_album=:id_artiste;");
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();



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

    /**Récupère la liste des albums dont le titre correspond à la chaine entrée
     * @param $album
     * @return array|false
     */
    static function getAlbumBySearch($album){

        try{

            $conn = Database::connexionBD();
            $statement = $conn->prepare("SELECT id_album, titre_album,
                                 photo_album, ar.id_artiste, pseudo_artiste
                                                FROM album
                                                JOIN artiste ar using (id_artiste)
                                                WHERE titre_album ILIKE '%' || :album || '%'
                                                ORDER BY titre_album");
            $statement->bindParam(':album', $album);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }

    }

}

?>