<?php

class Style
{
    public $id_style;
    public $nom_style;

    public function __construct($dbRow){
        $this->id_style = $dbRow["id_style"];
        $this->nom_style = $dbRow["nom_style"];
    }

}

?>