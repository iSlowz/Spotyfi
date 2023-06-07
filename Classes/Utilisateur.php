<?php
session_start();
require_once('Database.php');
class Utilisateur
{

    static function Connexion()
    {
        $path = explode('/', $_SERVER['PHP_SELF']);
        $file = array_pop($path);

        if (isset($_SESSION['user'])) {
            if ($file == 'Login.php') {
                header('Location: Accueil.php');
            }
            return $_SESSION['user'];
        }

        if (!isset($_SESSION['id_utilisateur']) && $file != 'Login.php') {    //deco
            header('Location: Login.php');
        }


        if (!empty($_POST['mail']) && !empty($_POST['password'])) {
            try {
                $conn = Database::connexionBD();
                $statement = $conn->prepare('SELECT id_user, mot_de_passe FROM users WHERE mail_user=:mail');
                $statement->bindParam(':mail', $_POST['mail']);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Connection error: ' . $exception->getMessage());
                return false;
            }

            if (password_verify($_POST['password'], $result['mot_de_passe']) && !empty($result)) {
                $_SESSION['user'] = $result['id_user'];
                header('Location: Accueil.php');
            } else {
                return "E-Mail ou Mot de passe invalide !";
            }
            return $_SESSION['user'];
        }
        return false;
    }

    static function sign_up()
    {

        if (!empty($_POST)) {
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
            if (!empty($manquant)){
                return $manquant;
            }
            else{
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
                if (!empty($result)) {
                    return 'Adresse déjà utilisée !';
                }
                try {
                    $timestamp = strtotime($_POST["naissance"]); // Formatage du timestamp en SQL DATE
                    $naissance = date('Y-m-d', $timestamp);

                    $statement = $conn->prepare("INSERT INTO users(prenom_user, nom_user, date_naissance_user, mail_user, mot_de_passe) 
                                                VALUES (:prenom, :nom, :naissance, :mail, :mot_de_passe)");

                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
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

                //on ajoute Favoris et Historique
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

    static function deconnexion()
    {
        unset($_SESSION['user']);
        header('Location: Login.php');
    }

}

?>