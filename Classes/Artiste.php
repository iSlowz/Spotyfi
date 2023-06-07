<?php

class Artiste //Classe qui gère les artistes
{
    /**Récupère les informations, musiques et albums d'un artiste
     * @param $id_artiste, id de l'artiste
     */
    static function getArtiste($id_artiste){
        try {   //récupère ses infos
            $conn = Database::connexionBD();
            $statement = $conn->prepare("SELECT id_artiste, pseudo_artiste, nom_artiste, prenom_artiste, type_artiste, s.id_style, nom_style
                    FROM artiste JOIN style s on artiste.id_style = s.id_style
                    WHERE id_artiste=:id_artiste");
            $statement->bindParam(':id_artiste', $id_artiste);
            $statement->execute();
            $result= $statement->fetch(PDO::FETCH_ASSOC);

            //récupère ses musiques
            $statement = $conn->prepare("SELECT id_musique,  titre_musique, lien_musique, duree_musique, a.id_album, titre_album FROM musique JOIN album a on musique.id_album = a.id_album WHERE musique.id_artiste=:id_artiste");
            $statement->bindParam(':id_artiste', $id_artiste);
            $statement->execute();
            $result["musiques"] = $statement->fetchAll(PDO::FETCH_ASSOC);
            for ($i=0;$i<count($result["musiques"]);$i++) {
                list($heures, $minutes, $secondes) = explode(":", $result["musiques"][$i]["duree_musique"]);
                $dureeFormatee = sprintf("%02d:%02d", $minutes, $secondes);
                $result["musiques"][$i]["duree_musique"] = $dureeFormatee;
            }
            try{
                //récupère ses albums
                $conn = Database::connexionBD();
                $statement = $conn->prepare("SELECT id_album, titre_album, photo_album, date_creation_album
                                            FROM album
                                            WHERE id_artiste=:artiste");
                $statement->bindParam(':artiste', $id_artiste);
                $statement->execute();
                $result["albums"]= $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Connection error: '.$exception->getMessage());
                return false;
            }
            return $result;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    /** Récupère la liste des artistes dont le pseudo correspond à la chaine entrée
     * @param $artiste
     */
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
