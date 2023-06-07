<?php

class Musique   //Classe qui gère les musiques
{

    /**Récupère les informations d'une playlist
     * @param $id_musique, id de la musique
     * @param null $id_user, id de l'utilisateur, entrée si besoin de ssavoir s'il aime la musique

     */
    static function getMusique($id_musique, $id_user=null){
        try {

            //Récupère les informations de la musique
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
            //formate durée de la musique
            list($heures, $minutes, $secondes) = explode(":", $result["duree_musique"]);
            $dureeFormatee = sprintf("%02d:%02d", $minutes, $secondes);
            $result["duree_musique"] = $dureeFormatee;

            //Ajoute un booléen de si l'utilisateur aime ou non la musique
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

    /**Récupère la liste des musiques dont le titre correspond à la chaine entrée
     * @param $musique, la chaine entrée
     * @return array|false
     */
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

            //formate durée de chaque musique
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

    /** Ajoute à la playlist Favoris de l'utilisateur une musique
     * @param $id_user, id de l'utilisateur
     * @param $id_musique, id de la musique
     */
    static function likeMusic($id_user, $id_musique){
        try { //récupère l'id de la playlist Favoris de l'utilisateur grace à son id
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
        try {   //Ajoute la musique à la playlist
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

    /**Enlève des favoris une musique
     * @param $id_user
     * @param $id_musique
     */
    static function unlikeMusic($id_user, $id_musique){
        try {//récupère l'id de la playlist Favoris de l'utilisateur grace à son id
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
        try {//Enleve la musique de la playlist
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

    /**Vérifie si la musique est dans les Favoris de l'utilisateur
     * @param $id_user, id de l'utilisateur
     * @param $id_musique, id de la musique
     */
    static function isFavori($id_user, $id_musique){
        try {//récupère l'id de la playlist Favoris de l'utilisateur grace à son id
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
        try {   //Regarde si musique dans favoris
            $conn = Database::connexionBD();
            $statement = $conn->prepare("SELECT id_musique FROM musique_playlist
                                                    WHERE id_musique=:id_musique AND id_playlist=:id_playlist");
            $statement->bindParam(':id_musique', $id_musique);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            $result=$statement->fetch()[0];
            if (empty($result)){    //Si pas de resultar, non
                return false;
            }
            return true; //sinon oui
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    /** Ajoute dans l'historique de l'utilisateur une musique
     * @param $id_musique, id de la musique
     * @param $id_user, id de l'utilisateur
     */
    static function addInHistorique($id_musique, $id_user){
        try {
            $conn = Database::connexionBD();
            //On trouve la playlist historique de l'utilisateur
            $statement = $conn->prepare("SELECT playlist.id_playlist FROM playlist 
                                                    WHERE id_user=:id_user AND titre_playlist='Historique'");
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();
            $id_playlist=$statement->fetch()[0];
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }

        //supprime la musique de l'historique si elle y est (pour la remettre en dernière écoutée)
        Playlist::deleteMusique($id_musique, $id_playlist);

        try {
            //Ajoute la musique à la playlist Historique de l'utilisateur
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