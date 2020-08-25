<!DOCTYPE html>
<html>
<head>
	<title>Qcm</title>
    <link rel="stylesheet" type="text/css" href="public/css/form.css">
</head>
<body>

<?php
    include('models/Question.php');
    include('models/Reponse.php');
    include('models/Qcm.php');
?>

<?php

    const bareme = 20;

    $qcm = new Qcm();
        
    $question1 = new Question('Et paf, ça fait ...');
    $question1->ajouterReponse(new Reponse('Des mielpops'));
    $question1->ajouterReponse(new Reponse('Des chocapics', Reponse::BONNE_REPONSE));
    $question1->ajouterReponse(new Reponse('Des actimels'));
    $question1->setExplications('Et oui, la célèbre citation est « Et paf, ça fait des chocapics ! »');
    $qcm->ajouterQuestion($question1);

    $question2 = new Question('POO signifie');
    $question2->ajouterReponse(new Reponse('Php Orienté Objet'));
    $question2->ajouterReponse(new Reponse('ProgrammatiOn Orientée'));
    $question2->ajouterReponse(new Reponse('Programmation Orientée Objet', Reponse::BONNE_REPONSE));
    $question2->setExplications('Sans commentaires si vous avez eu faux :-°');
    $qcm->ajouterQuestion($question2);

    $question2 = new Question('Question test');
    $question2->ajouterReponse(new Reponse('Rep 1', Reponse::BONNE_REPONSE));
    $question2->ajouterReponse(new Reponse('Rep 2'));
    $question2->setExplications('Explications');
    $qcm->ajouterQuestion($question2);

    $qcm->setAppreciation(array('0-10' => 'Pas top du tout ...',
                                '10-20' => 'Très bien ...'));
    if($_POST == null){
        $qcm->generer();
    }else{ //Form handling (should be separate in controller)
        $note = 0;
        foreach($_POST as $q => $r){
            $question = $qcm->getQuestionFromMd5($q);
            $correcte = true;
            foreach($r as $resp){
                if($correcte == false)
                    break;
                foreach($question->getReponses() as $reponse){
                    if($resp == $reponse->getMd5() && $reponse->getValeur() == Reponse::MAUVAISE_REPONSE){
                        $correcte = false;
                        break;
                    }
                }
            }
            if($correcte == true)
                $note += bareme / count($_POST); //Assuming it's +1 for each good answer (according ratio), we can change that to another rule.

        }
        if($note < 0)
            $note = 0;
        echo "<div class=\"form-resultat\">";
        echo "Note: " . $note . "<br>";
        foreach($qcm->getAppreciations() as $app => $com){
            $range = explode ("-", $app); //Get notation range
            if(intval($range[0]) <= $note && $note <= intval($range[1]) ){
                echo $com;
                break;
            }
        }
        foreach($qcm->getQuestions() as $q){
            echo "<div class=\"form-explication\">";
            echo $q->getQuestion() . "<br> Explications: " . $q->getExplication(); 
            echo "</div>";
        }
        echo "</div>";
        
        
        
    }
?>
</body>
</html>