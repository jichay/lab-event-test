<?php

class Qcm {

    public $questions = [];
    public $appreciations;


    public function ajouterQuestion($questions){
        $this->questions[] = $questions; 
    }

    public function setAppreciation($appreciations){
        $this->appreciations = $appreciations;
    }

    public function getQuestions(){
        return $this->questions;
    }

    /**
     * Get question object from it's md5
     */
    public function getQuestionFromMd5($md5) {
        foreach($this->questions as $q) {
            if(md5($q->getQuestion()) == $md5) {
                return $q;
            }
        }
        return false;
    }
    
    public function getAppreciations(){
        return $this->appreciations;
    }

    public function generer(){
        echo "<form method=\"post\" class=\"form-global\">";
        foreach($this->questions as $q){
            echo "<div class=\"form-qr\">";
                $q->generer();
            echo "</div>";
        }
        echo "<button type=\"submit\" class=\"form-button\">Envoyer</button>";
        echo "</form>";
    }

}

?>

