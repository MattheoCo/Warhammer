<?php
include 'db.php';

// Récupérer toutes les catégories
$categories_query = $pdo->query("SELECT * FROM categories");
$categories = $categories_query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warhammer - Guide du Consommateur</title>
    <link rel="stylesheet" href="../front/style.css">
</head>
<body>
<header class="header">
    <div class="header-top">
        <h1>Warhammer - We need to build a wall</h1>
    </div>
    <nav class="navbar">
        <ul class="menu">
            <li><a href="index.php">Guide</a></li>
            <li><a href="cartes.php">Cartes</a></li>
            <li><a href="fiches_perso.php">Fiches Perso</a></li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Prix</a>
                <div class="dropdown-content">
                    <?php foreach ($categories as $categorie): ?>
                        <a href="prix.php?cat=<?php echo strtolower($categorie['nom']); ?>">
                            <?php echo htmlspecialchars($categorie['nom']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </li>
            <li><a href="divers.php">Divers</a></li>
        </ul>
    </nav>
</header>
