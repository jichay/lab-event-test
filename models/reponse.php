<?php

class Reponse {
    public $reponse;
    public $valeur;

    const BONNE_REPONSE = true;
    const MAUVAISE_REPONSE = false;

    function __construct($reponse, $valeur = Reponse::MAUVAISE_REPONSE) {
        $this->valeur = $valeur;
        $this->reponse = $reponse;
    }

    public function getValeur(){
        return $this->valeur;
    }

    public function getMd5(){
        return md5($this->reponse); //TODO change hash algorithm, it can cause security issue.
    }

    public function generer($questionMd5){
        echo "<div class=\"form-reponse\">";
        echo "<input type=\"checkbox\" name=\"" . $questionMd5 . "[]\" value=\"".$this->getMd5()."\">";
        echo "<label for=\"".$this->getMd5()."\">" . $this->reponse . "</label>";
        echo "</div>";
    }

}
?>