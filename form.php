<?php
    require_once 'connexionServeur.php';
    include 'function.php';
    //---------------------------------------------------\\
    //                                                   \\
    #      Traitement de l'ajout de nouvelle blague       #
    //                                                   \\
    //---------------------------------------------------\\
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['joke']) && !empty($_POST['joke'])) {
        $tacheNom = $_POST['joke'];
        addTache($dbClient, $joke);
        header('Location: index.php');
        exit;
    }
?>
