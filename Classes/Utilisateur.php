<?php
session_start();
require_once('Database.php');
class Utilisateur   //Classe qui gere l'ajout et le changement d'informations de l'utilisateur (ses informations)
{
    /**Permet à l'utilisateur de se connecter
     * @return false|mixed|string
     */
    static function Connexion()
    {
        $path = explode('/', $_SERVER['PHP_SELF']);
        $file = array_pop($path);   //Fichier où se trouve l'utilisateur

        if (isset($_SESSION['user'])) { //Si l'utilisateur est connecté
            if ($file == 'Login.php') { //Et qu'il est sur la page de connexion
                header('Location: Accueil.php'); //On l'envoie à l'accueil
            }
            return $_SESSION['user'];   //on renvoie sa session dans tous les cas s'il en a une
        }

        if (!isset($_SESSION['id_utilisateur']) && $file != 'Login.php') {    //Utilisateur qui se déconnecte
            header('Location: Login.php');
        }


        if (!empty($_POST['mail']) && !empty($_POST['password'])) { //S'il a rentré les deux champs
            try {
                $conn = Database::connexionBD();
                $statement = $conn->prepare('SELECT id_user, mot_de_passe FROM users WHERE mail_user=:mail');
                //on récupère le mot de passe associé au mail
                $statement->bindParam(':mail', $_POST['mail']);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Connection error: ' . $exception->getMessage());
                return false;
            }

            if (password_verify($_POST['password'], $result['mot_de_passe']) && !empty($result)) { //si les deux passwords sont les mêmes
                $_SESSION['user'] = $result['id_user'];
                header('Location: Accueil.php');
            } else {    //sinon
                return "E-Mail ou Mot de passe invalide !";
            }
            //on retourne sa session pour les prochains fichiers
            return $_SESSION['user'];
        }
        return false;
    }

    /**Permet à l'utilisateur de s'enregistrer
     * @return array|false|string
     */
    static function sign_up()
    {

        if (!empty($_POST)) {   //On verifie que tous les champs sont remplis et valides
            $manquant=Array();
            $valide = True;

            if (empty($_POST['prenom'])) {
                $manquant['prenom']=True;
                $valide = False;
            }
            if (empty($_POST['nom'])) {
                $manquant['nom']=True;
                $valide = False;
            }

            if (empty($_POST['naissance']) or strtotime($_POST['naissance'])>time()){
                $manquant['naissance']=True;
                $valide = False;
            }
            if (empty($_POST['mail']) or !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $manquant['mail']=True;
                $valide = False;
            }

            if (empty($_POST['password'])) {
                $manquant['password']=True;
                $valide = False;
            }
            if ($valide and !empty($_POST['verif_password'])){
                if ($_POST['password']!=$_POST['verif_password']){
                    $manquant["verif"] = True;

                }
            }
            if (!empty($manquant)){ //si il manque quelque chose, on stop et on renvoie ce qu'il manque
                return $manquant;
            }
            else{   //sinon on vérifie si le mail existe dans la base (est déjà pris)
                try {
                    $conn = Database::connexionBD();

                    $statement = $conn->prepare("SELECT id_user FROM users WHERE mail_user=:mail");
                    $statement->bindParam(':mail', $_POST['mail']);
                    $statement->execute();
                    $result = $statement->fetch(PDO::FETCH_ASSOC);
                } catch (PDOException $exception) {
                    error_log('Connection error: '.$exception->getMessage());
                    return false;
                }
                if (!empty($result)) {  //s'il adresse mail déjà présente on arrête
                    return 'Adresse déjà utilisée !';
                }
                //sinon on rentre ses informations
                try {
                    $timestamp = strtotime($_POST["naissance"]); // Formatage du timestamp en SQL DATE
                    $naissance = date('Y-m-d', $timestamp);

                    $statement = $conn->prepare("INSERT INTO users(prenom_user, nom_user, date_naissance_user, mail_user, mot_de_passe) 
                                                VALUES (:prenom, :nom, :naissance, :mail, :mot_de_passe)");

                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //on crypte le mot de passe
                    $statement->bindParam(":prenom", $_POST['prenom']);
                    $statement->bindParam(":nom", $_POST['nom']);
                    $statement->bindParam(":naissance", $naissance);
                    $statement->bindParam(":mail", $_POST["mail"]);
                    $statement->bindParam(":mot_de_passe", $password);
                    $statement->execute();
                } catch (PDOException $exception) {
                    error_log('Connection error: '.$exception->getMessage());
                    return false;
                }
                //on retrouve son id
                $statement = $conn->prepare('SELECT id_user FROM users WHERE mail_user=:mail');
                $statement->bindParam(':mail', $_POST['mail']);
                $statement->execute();
                $id=$statement->fetch(PDO::FETCH_ASSOC)["id_user"];

                //on ajoute dans ses playlists une playlist Favoris et une playlist Historique
                try {
                    $titre='Historique';
                    $statement = $conn->prepare("INSERT INTO playlist(titre_playlist, date_creation_playlist, id_user) 
                                                VALUES (:titre,NOW(), :id)");
                    $statement->bindParam(":titre", $titre);
                    $statement->bindParam(":id", $id);

                    $statement->execute();
                } catch (PDOException $exception) {
                    error_log('Connection error: '.$exception->getMessage());
                    return false;
                }
                try {
                    $titre='Favoris';
                    $statement = $conn->prepare("INSERT INTO playlist(titre_playlist, date_creation_playlist, id_user) 
                                                VALUES (:titre,NOW(), :id)");
                    $statement->bindParam(":titre", $titre);
                    $statement->bindParam(":id", $id);
                    $statement->execute();
                } catch (PDOException $exception) {
                    error_log('Connection error: '.$exception->getMessage());
                    return false;
                }
                header('Location: Login.php');
            }
        }
        return False;
    }

    /**
     * déconnecte l'utilisateur
     */
    static function deconnexion()
    {
        unset($_SESSION['user']);       //supprime sa session
        header('Location: Login.php');  //Le renvoie à la page de connexion
    }

}

?>