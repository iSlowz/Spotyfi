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
    static function getHistorique($id_user){
        try {
            $conn = Database::connexionBD();

            $statement = $conn->prepare("SELECT id_musique, titre_musique, pseudo_artiste, ar.id_artiste FROM musique_playlist mp 
                                                                JOIN playlist p using (id_playlist)  
                                                                JOIN musique m using (id_musique)
                                                                JOIN artiste ar using (id_artiste)
                                                                WHERE id_user=:id_user AND titre_playlist='Historique'");
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }



    static function getFavoris($id_user){
        try {
            $conn = Database::connexionBD();

            $statement = $conn->prepare("SELECT * FROM musique_playlist m JOIN playlist p using (id_playlist) WHERE id_user=:id_user AND titre_playlist='Favoris'");
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    static function getMusiques($id_playlist){  //prend les musiques d'une playlist
        try {
            $conn = Database::connexionBD();
            $result=Array();
            $statement = $conn->prepare("SELECT id_musique, date_ajout_musique_playlist, titre_musique,
                                 lien_musique, duree_musique, ar.id_artiste, pseudo_artiste, id_album, titre_album
                                                FROM musique_playlist JOIN musique m using (id_musique)
                                                JOIN artiste ar using (id_artiste)
                                                JOIN album  al using (id_album)
                                                WHERE id_playlist=:id_playlist");
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            $result["musiques"] = $statement->fetchAll(PDO::FETCH_ASSOC);

            for ($i=0;$i<count($result["musiques"]);$i++) {
                list($heures, $minutes, $secondes) = explode(":", $result["musiques"][$i]["duree_musique"]);
                $dureeFormatee = sprintf("%02d:%02d", $minutes, $secondes);
                $result["musiques"][$i]["duree_musique"] = $dureeFormatee;
            }
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
    public function addMusique($id_musique){
        try {
            $conn = Database::connexionBD();

            $statement = $conn->prepare("INSERT INTO public.musique_playlist(id_musique, id_playlist, date_ajout_musique_playlist) VALUES(:id_musique, :id_playlist, NOW())");
            $statement->bindParam(':id_musique', $id_musique);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    public function deleteMusique($id_musique){
        try {
            $conn = Database::connexionBD();

            $statement = $conn->prepare("DELETE FROM public.musique_playlist WHERE id_musique = :id_musique");
            $statement->bindParam(':id_musique', $id_musique);
            $statement->execute();
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }
}

?>
