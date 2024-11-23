<?php
// Inclusion de la connexion à la base de données
include 'db.php';

// Récupérer la catégorie via l'URL (exemple : prix.php?cat=armes)
$categories = [
    'armes' => 1,
    'armures' => 2,
    'nourriture' => 3,
    'vêtements' => 4,
    'divers' => 5
];

// Vérifier si la catégorie est valide
$cat = isset($_GET['cat']) ? strtolower($_GET['cat']) : null;
$categorie_id = isset($categories[$cat]) ? $categories[$cat] : null;

if (!$categorie_id) {
    die('Catégorie invalide ou manquante.');
}

// Récupérer les articles de cette catégorie
$query = $pdo->prepare("SELECT articles.nom, articles.disponibilite, articles.prix, articles.encumbrance, articles.devise
                        FROM articles
                        WHERE categorie_id = :categorie_id");
$query->execute(['categorie_id' => $categorie_id]);
$articles = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>

<main>
    <h2>Liste des articles - <?php echo ucfirst($cat); ?></h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Disponibilité</th>
            <th>Prix</th>
            <th>Devise</th>
            <th>Encumbrance</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($articles) > 0): ?>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?php echo htmlspecialchars($article['nom']); ?></td>
                    <td><?php echo htmlspecialchars($article['disponibilite']); ?></td>
                    <td><?php echo htmlspecialchars($article['prix']); ?></td>
                    <td><?php echo htmlspecialchars($article['devise']); ?></td>
                    <td><?php echo htmlspecialchars($article['encumbrance']); ?></td>

                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Aucun article trouvé pour cette catégorie.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include 'footer.php'; ?>
