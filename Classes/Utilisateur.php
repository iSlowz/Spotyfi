<?php
session_start();
require_once('Database.php');
class Utilisateur
{
    static function Connexion()
    {
        $path = explode('/', $_SERVER['PHP_SELF']);
        $file = array_pop($path);

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
                header('Location: Accueil.php');
            } else {
                return "E-Mail ou Mot de passe invalide !";
            }
            return $_SESSION['user'];
        }
        return false;
    }

}