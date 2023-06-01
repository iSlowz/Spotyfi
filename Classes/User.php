<?php

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

}

?>