<?php
require_once('Database.php');
class User
{
    public $id_user;
    public $prenom_user;
    public $nom_user;
    public $age_user;
    public $mail_user;
    public $mot_de_passe;

    public function __construct($dbRow){
        $this->id_user = $dbRow["id_user"];
        $this->prenom_user = $dbRow["prenom_user"];
        $this->nom_user = $dbRow["nom_user"];
        $this->age_user = $dbRow["age_user"];
        $this->mail_user = $dbRow["mail_user"];
        $this->mot_de_passe = $dbRow["mot_de_passe"];
    }

    public function getDbRow(){
        return array(              
            "id_user" => $this->id_user,
            "prenom_user" => $this->prenom_user,
            "nom_user" => $this->nom_user,
            "age_user" => $this->age_user,
            "mail_user" => $this->mail_user,
            "mot_de_passe" => $this->mot_de_passe
        );
    }

    static function getPlaylists($id_user){
        try {
            $dbh = Database::connexionBD();

            $statement = $dbh->prepare("SELECT id_playlist,titre_playlist FROM playlist WHERE  id_user = :user EXCEPT SELECT id_playlist,titre_playlist FROM playlist WHERE titre_playlist = 'Favoris' OR titre_playlist = 'Historique'");
            $statement->bindParam(':user', $id_user);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }
}

?>