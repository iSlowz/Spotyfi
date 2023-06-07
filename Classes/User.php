<?php
require_once('Database.php');
class User  //Classe qui gère les playlists et activités de l'utilisateur (sa consommation)
{
    /**Récupère les playlists d'un utilisateur
     * @param $id_user
     */
    static function getPlaylists($id_user){
        try { // On trouve ses favoris
            $conn = Database::connexionBD();

            $statement = $conn->prepare("SELECT id_playlist, titre_playlist FROM playlist WHERE id_user=:id_user AND titre_playlist='Favoris' ORDER BY date_creation_playlist DESC");
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();
            $result["favoris"] = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log('Connection error: '.$exception->getMessage());
            return false;
        }

        try {   //On trouve ses autres playlists
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

    /**Récupère le profil d'un utilisateur
     * @param $id_user
     *
     */
    static function getProfil($id_user){
        try {
            $conn = Database::connexionBD();
            $statement = $conn->prepare("SELECT id_user,prenom_user, nom_user, date_naissance_user, mail_user FROM users WHERE id_user = :id_user");
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();
            $result= $statement->fetch(PDO::FETCH_ASSOC);

            //calcule son age
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

    /**Modifie le profil de l'utilisateur
     * @param $id
     * @param $nom
     * @param $prenom
     * @param $date, date de naissance
     * @param $mail
     * @param $mdp, mot de passe
     * @return bool|string
     */
    static function modify($id, $nom, $prenom, $date, $mail,$mdp){

        try
        {   //cherche si le nouveau mail est déjà pris par un autre utilisateur
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

        if (!empty($result)) {  //si oui stop
            $erreur = 'Mail déjà utilisé';
            return $erreur;
        }
        try
        {   //sinon modifie ses informations
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

    /**Ajoute à l'utilisateur une playlist
     * @param $id_user, l'id de l'utilisateur
     * @param $titre, le titre de la playlist
     * @return bool
     */
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