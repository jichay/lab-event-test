<?php

class Question {

    public $reponses = [];
    public $question;
    public $explication;

    function __construct($question) {
        $this->question = $question;
    }

    public function ajouterReponse($resp){
        $this->reponses[] = $resp; 
    }

    public function setExplications($explication){
        $this->explication = $explication;
    }

    public function getQuestion(){
        return $this->question;
    }

    public function getExplication(){
        return $this->explication;
    }

    public function getReponses(){
        return $this->reponses;
    }

    public function generer(){
        echo "<div class=\"form-question\">";
        echo $this->question;
        echo "</div>";
        foreach($this->reponses as $r){
            $r->generer(md5($this->question));
        }
    }

}

?>