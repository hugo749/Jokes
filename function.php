<?php
//---------------------------------------------------\\
//                                                   \\
#         Fonction pour récupérer les blagues         #
//                                                   \\
//---------------------------------------------------\\
function addJokes($dbClient, $joke, $answer) {
    $sql = 'INSERT INTO joke (joke, answer) VALUES (:joke, :answer)';
    $stmt = $dbClient->prepare($sql);
    $stmt->execute([
        ':joke' => $joke,
        ':answer' => $answer
    ]);
}
//---------------------------------------------------\\
//                                                   \\
#      Fonction pour récupérer les commentaires       #
//                                                   \\
//---------------------------------------------------\\
function addComments($dbClient, $author_name, $content, $joke_id) {
    $sql = 'INSERT INTO comment (author_name, content, joke_id) VALUES (:author_name, :content, :joke_id)';
    $stmt = $dbClient->prepare($sql);
    $stmt->execute([
        ':author_name' => $author_name,
        ':content' => $content,
        ':joke_id' => $joke_id
    ]);
}
?>
