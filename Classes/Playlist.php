<?php
require_once('Musique.php');
class Playlist  //gère les playlists
{
    /**Récupére l'historique d'un utilisateur
     * @param $id_user, son id
     */
    static function getHistorique($id_user){
        try {
            $conn = Database::connexionBD();

            $statement = $conn->prepare("SELECT id_musique, titre_musique, pseudo_artiste, ar.id_artiste FROM musique_playlist mp 
                                                                JOIN playlist p using (id_playlist)  
                                                                JOIN musique m using (id_musique)
                                                                JOIN artiste ar using (id_artiste)
                                                                WHERE id_user=:id_user AND titre_playlist='Historique' 
                                                            ORDER BY mp.date_ajout_musique_playlist DESC LIMIT 10");
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    /**Récupère les musiques d'un playlist
     * @param $id_playlist
     */
    static function getMusiques($id_playlist){
        try {//recupère l'utilisateur de la playlist, pour savoir ensuite s'il a like les musiques
            $conn = Database::connexionBD();

            $statement = $conn->prepare("SELECT id_user FROM playlist 
                                                    WHERE id_playlist=:id_playlist");
            $statement->bindParam(':id_musique', $id_musique);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            $id_user = $statement->fetch()[0];
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }

        try {   //Récupère toutes les musiques et leurs infos
            $conn = Database::connexionBD();
            $result=Array();
            $statement = $conn->prepare("SELECT id_musique, date_ajout_musique_playlist, titre_musique,
                                 lien_musique, duree_musique, ar.id_artiste, pseudo_artiste, id_album, photo_album, titre_album
                                                FROM musique_playlist JOIN musique m using (id_musique)
                                                JOIN artiste ar using (id_artiste)
                                                JOIN album  al using (id_album)

                                                WHERE id_playlist=:id_playlist");
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            $result["musiques"] = $statement->fetchAll(PDO::FETCH_ASSOC);
            for ($i=0;$i<count($result["musiques"]);$i++) {
                //Formate la durée de la musique
                list($heures, $minutes, $secondes) = explode(":", $result["musiques"][$i]["duree_musique"]);
                $dureeFormatee = sprintf("%02d:%02d", $minutes, $secondes);
                $result["musiques"][$i]["duree_musique"] = $dureeFormatee;

                //formate la date d'ajout de
                $timestamp = $result["musiques"][$i]["date_ajout_musique_playlist"];
                $date = date("d-m-Y", strtotime($timestamp));
                $result["musiques"][$i]["date_ajout_musique_playlist"] = $date;

                if (Musique::isFavori($id_user,$result["musiques"][$i]["id_musique"])){
                    $result["musiques"][$i]["like"]=true;
                }
                else{
                    $result["musiques"][$i]["like"]=false;
                }


            }
            $statement = $conn->prepare("SELECT id_playlist, titre_playlist, date_creation_playlist FROM playlist WHERE id_playlist=:id_playlist");
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            $result += $statement->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }
    static function addMusique($id_playlist ,$id_musique){
        try {
            $conn = Database::connexionBD();

            $statement = $conn->prepare("INSERT INTO public.musique_playlist(id_musique, id_playlist, date_ajout_musique_playlist) VALUES(:id_musique, :id_playlist, NOW())");
            $statement->bindParam(':id_musique', $id_musique);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            return true;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    static function deleteMusique($id_musique, $id_playlist){
        try {
            $conn = Database::connexionBD();

            $statement = $conn->prepare("DELETE FROM musique_playlist WHERE id_musique = :id_musique AND id_playlist=:id_playlist");
            $statement->bindParam(':id_musique', $id_musique);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            return true;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    static function deletePlaylist($id_playlist){

        try{
            $conn = Database::connexionBD();

            $statement = $conn->prepare("DELETE FROM musique_playlist WHERE id_playlist =:id_playlist");
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            $statement = $conn->prepare("DELETE FROM playlist WHERE id_playlist =:id_playlist");
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            return true;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }

    }

    static function modifyName($id_playlist, $titre){
        try{
            $conn = Database::connexionBD();

            $statement = $conn->prepare("UPDATE playlist SET titre_playlist=:titre WHERE id_playlist =:id_playlist");
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->bindParam(':titre', $titre);
            $statement->execute();
            return true;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

}

?>
