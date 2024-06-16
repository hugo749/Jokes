<?php
include 'connexionServer.php'; // Inclusion du fichier de connexion
include 'function.php'; // Inclusion du fichier de fonctions

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["joke"]) && isset($_POST["answer"])) {
        $joke = $_POST["joke"];
        $answer = $_POST["answer"];
        addJokes($dbClient, $joke, $answer);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST["comment"]) && isset($_POST["content"]) && isset($_POST["joke_id"])) {
        $author_name = $_POST["comment"];
        $content = $_POST["content"];
        $joke_id = $_POST["joke_id"];
        addComments($dbClient, $author_name, $content, $joke_id);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
$items = getJokes($dbClient); // Récupération des blagues depuis la base de données
?>
<!DOCTYPE html>
<html class="has-background-warning-light" lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blagues</title>
    <style>
        .sticky-column {
            position: sticky;
            top: 0;
        }
    </style>
</head>
<body>
<div class="my-6 mx-6 pgh-large has-text-left">
    <div class="columns">
        <div class="column is-one-quarter mt-6">
            <div class="control sticky-column">
                <br>
                <form action="index.php" method="post">
                    <textarea class="textarea mt-3" type="text" name="joke" placeholder="C'est l'histoire du ptit dej, tu la connais ?"></textarea>
                    <textarea class="textarea mt-3" name="answer" placeholder="Pas de bol."></textarea>
                    <button type="submit" class="mt-3 button is-warning is-dark button is-fullwidth">Ajouter ma blague</button>
                </form>
            </div>
        </div>
        <div class="column mt-0 pt-0 pl-6 pr-6">
            <h1 class="title is-3">Envie d'une petite blague ?</h1>
            <div class="jokes-list">
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $joke): ?>
                        <br>
                        <div class="card p-6">
                            <h2 class="has-text-weight-bold is-size-4"><?= $joke['joke'] ?></h2>
                            <p class="has-text-grey-light is-italic"><?= $joke['answer'] ?></p><br>
                            <?php
                            $nextitems = getCommentsByJoke($dbClient, $joke['id']); // Récupération des commentaires pour la blague actuelle
                            ?>
                            <hr />
                            <h2 class="has-text-weight-medium is-size-5">Commentaires</h2><br>
                            <?php if (!empty($nextitems)): ?>
                                <?php foreach ($nextitems as $content): ?>
                                    <p><?= $content['author_name'] . " - " . $content['content'] ?></p>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="has-text-grey-light">Il n'y a pas encore de commentaires, soyez le premier !</p>
                            <?php endif; ?>
                            <br>
                            <form action="index.php" method="post">
                                <input type="hidden" name="joke_id" value="<?= $joke['id'] ?>">
                                <input class="input mt-3" type="text" name="comment" placeholder="Kevin">
                                <input class="input mt-3" name="content" placeholder="Cette blague est top !">
                                <button type="submit" class="mt-3 button is-warning is-white button is-fullwidth">Ajouter le commentaire</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune blague disponible.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
