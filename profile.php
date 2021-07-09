<?PHP

require_once './data/database/database.php';
require_once './data/database/security.php';
$articleDb = require_once './data/database/models/article_Db.php';
$currentUser = isLoggedin();
if (!$currentUser) {
    header('Location: /');
}

$articles = $articleDb->fetchUserArticle($currentUser['id']);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/css/profile.css">
    <title>Mon Profil</title>
</head>

<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
            <h1>Mon espace</h1>
            <h2>Mes informations</h2>
            <div class="info-container">
                <ul>
                    <li>
                        <strong>Prénom :</strong>
                        <p><?= $currentUser['firstname'] ?></p>
                    </li>
                    <li>
                        <strong>Nom :</strong>
                        <p><?= $currentUser['lastname'] ?></p>
                    </li>
                    <li>
                        <strong>Email :</strong>
                        <p><?= $currentUser['email'] ?></p>
                    </li>
                </ul>
            </div>
            <h2>Mes articles</h2>
            <div class="articles-list">
                <ul>
                    <?php foreach ($articles as $a) : ?>
                        <li>
                            <span><?= $a['title'] ?></span>
                            <div class="article-actions">
                                <a href="/delete-article.php?id=<?= $a['id'] ?>" class="btn btn-secondary btn-small">Supprimer</a>
                                <a href="/add_article.php?id=<?= $a['id'] ?>" class="btn btn-primary btn-small">Modifier</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php require_once 'includes/footer.php' ?>
    </div>

</body>

</html>