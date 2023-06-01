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
            if ($file == 'index.php') {
                header('Location: private/Accueil.php');
            }
            return $_SESSION['user'];
        }

        if (!empty($_POST['mail']) && !empty($_POST['password'])) {
            try {
                $conn = Database::connexionBD();
                $statement = $conn->prepare('SELECT id_user, mot_de_passe FROM users WHERE mail_user=:mail');
                $statement->bindParam(':mail', $_POST['mail']);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                print_r($result);
            } catch (PDOException $exception) {
                error_log('Connection error: ' . $exception->getMessage());
                return false;
            }

            if ($_POST['password'] == $result['mot_de_passe'] && !empty($result)) {
                $_SESSION['user'] = $result['id_user'];
                header('Location: private/Accueil.php');
            } else {
                return "E-Mail ou Mot de passe invalide !";
            }
            return $_SESSION['user'];
        }
        return false;
    }

    static function sign_up()
    {
        $manquant=Array();
        $valide = True;
        if (!empty($_POST)) {
            if (empty($_POST['nom'])) {
                $manquant['nom']=True;
                $valide = False;
            }
            if (empty($_POST['prenom'])) {
                $manquant['prenom']=True;
                $valide = False;
            }

            if (empty($_POST['age'])) {
                $manquant['age']=True;
                $valide = False;
            }
            if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $manquant['mail']=True;
                $valide = False;
            }

            if (empty($_POST['password'])) {
                $manquant['password']=True;
                $valide = False;
            }
            if ($valide and !empty($_POST['verif_password'])){
                $manquant["verif"]=True;
            }
            if (!empty($manquant)){
                return $manquant;
            }
        }
        return False;
    }
}