<?php
session_start();

class Utilisateur
{
    static function Login()
    {
        $path = explode('/', $_SERVER['PHP_SELF']);
        $file = array_pop($path);

        if (isset($_SESSION["utilisateur"])) {
            if ($file == 'index.php') {
                header('Location: ../Accueil.php');
            }
            if (!empty($_POST[' mail']) && !empty($_POST['mdp'])) {
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

                if (password_verify($_POST['password'], $result['mdp']) && !empty($result)) {
                    $_SESSION['id_user'] = $result['id_user'];
                    header('Location: ../Accueil.php');
                } else {
                    return "EMail ou Mot de passe incorrect !";
                }
                return $_SESSION['id_utilisateur'];
            }
            return false;
        }
    }
}