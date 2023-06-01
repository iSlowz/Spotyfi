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

    public function addMusique($id_musique){
        try {
            $dbh = Database::connexionBD();

            $statement = $dbh->prepare("INSERT INTO public.musique_playlist(id_musique, id_playlist, date_ajout_musique_playlist) VALUES(:id_musique, :id_playlist, NOW())");
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
            $dbh = Database::connexionBD();

            $statement = $dbh->prepare("DELETE * FROM public.musique_playlist WHERE id_musique = :id_musique");
            $statement->bindParam(':id_musique', $id_musique);
            $statement->execute();
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }
}

?>
