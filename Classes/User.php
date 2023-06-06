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
            $conn = Database::connexionBD();

            $statement = $conn->prepare("SELECT id_playlist, titre_playlist FROM playlist WHERE id_user=:id_user AND titre_playlist='Favoris' ORDER BY date_creation_playlist DESC");
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();
            $result["favoris"] = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }

        try {
            $conn = Database::connexionBD();

            $statement = $conn->prepare("SELECT id_playlist,titre_playlist FROM playlist WHERE id_user = :user EXCEPT SELECT id_playlist,titre_playlist FROM playlist WHERE titre_playlist = 'Favoris' OR titre_playlist = 'Historique'");
            $statement->bindParam(':user', $id_user);
            $statement->execute();
            $result["playlists"] = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    static function getProfil($id_user){
        try {
            $conn = Database::connexionBD();
            $statement = $conn->prepare("SELECT id_user,prenom_user, nom_user, date_naissance_user, mail_user FROM users WHERE id_user = :id_user");
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();
            $result= $statement->fetch(PDO::FETCH_ASSOC);
            $naissance = new DateTime($result["date_naissance_user"]);
            $actuelle = new DateTime(date('Y-m-d'));
            $difference = date_diff($naissance, $actuelle);
            $age = $difference->format('%Y');
            $result["age"]=$age;
            return $result;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }

    static function modify($id, $nom, $prenom, $date, $mail,$mdp){

        try
        {
            $dbh = Database::connexionBD();
            $statement = $dbh->prepare("SELECT mail_user FROM users
                                                WHERE mail_user=:mail AND id_user!=:id");
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':id', $id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }

        if (!empty($result)) {
            $erreur = 'Mail déjà utilisé';
            return $erreur;
        }
        try
        {
            $password = password_hash($mdp, PASSWORD_BCRYPT);
            $dbh = Database::connexionBD();
            $statement = $dbh->prepare('UPDATE users SET nom_user=:nom, prenom_user=:prenom, date_naissance_user=:date, mail_user=:mail, mot_de_passe=:mdp WHERE id_user=:id');
            $statement->bindParam(':id', $id);
            $statement->bindParam(':nom', $nom);
            $statement->bindParam(':prenom', $prenom);
            $statement->bindParam(':date', $date);
            $statement->bindParam(':mail', $mail);
            $statement->bindParam(':mdp',$password);
            $statement->execute();
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
        return true;
    }

    static function addPlaylist($id_user, $titre){
        try {
            if ($titre!="Favoris" and $titre!="Historique") {
                $conn = Database::connexionBD();
                $statement = $conn->prepare("INSERT INTO playlist(titre_playlist, date_creation_playlist, id_user) VALUES(:titre, NOW(), :id_user)");
                $statement->bindParam(':id_user', $id_user);
                $statement->bindParam(':titre', $titre);
                $statement->execute();
            }
            return true;
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }
    }
}

?>