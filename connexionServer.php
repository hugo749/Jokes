<?php
    //---------------------------------------------------\\
    //                                                   \\
    #            Connexion à la base de donnée            #
    //                                                   \\
    //---------------------------------------------------\\
    try {
        $dbClient = new PDO("mysql:host=localhost;dbname=jokes", 'root', 'root');
    }
    catch (Exception $e) {  
        echo''. $e->getMessage() .'';
        die();
    }
    //---------------------------------------------------\\
    //                                                   \\
    #            Selectionner tout les blagues            #
    //                                                   \\
    //---------------------------------------------------\\
    function getJokes($dbClient){
        $sql = 'SELECT * FROM joke';
        $stmt = $dbClient->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //---------------------------------------------------\\
    //                                                   \\
    #            Selectionner tout les auteurs            #
    //                                                   \\
    //---------------------------------------------------\\
    function getComments($dbClient){
        $sql = 'SELECT * FROM comment';
        $stmt = $dbClient->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //---------------------------------------------------\\
    //                                                   \\
    #      Fonction pour récupérer les commentaires       #
    #            pour une blague spécifique               #
    //                                                   \\
    //---------------------------------------------------\\
    function getCommentsByJoke($dbClient, $jokeId) {
        $sql = 'SELECT * FROM comment INNER JOIN joke ON comment.joke_id = joke.id WHERE joke.id = :jokeId';
        $stmt = $dbClient->prepare($sql);
        $stmt->bindParam(':jokeId', $jokeId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>  