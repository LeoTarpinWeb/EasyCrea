<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartes du Deck - EasyCrea</title>
    <link rel="stylesheet" href="/EasyCrea/public/css/style.css">
</head>
<body>
    <header>
        <h1>Cartes du Deck</h1>
        <nav>
            <a href="/EasyCrea/public/index.php?url=logout">Déconnexion</a>
        </nav>
    </header>

    <main>
        <h2>Liste des Cartes pour le Deck ID : <?php echo htmlspecialchars($_GET['deck_id']); ?></h2>

        <!-- Liste des cartes -->
        <?php if (!empty($cards)): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Texte de la Carte</th>
                            <th>Impact Population Choix 1</th>
                            <th>Impact Finances Choix 1</th>
                            <th>Impact Population Choix 2</th>
                            <th>Impact Finances Choix 2</th>
                            <th>Date de Soumission</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($cards as $card): ?>
        <tr>
            <td data-label="Texte de la Carte"><?php echo htmlspecialchars($card['texte_carte']); ?></td>
            <td data-label="Impact Population Choix 1"><?php echo htmlspecialchars($card['valeurs_population_choix1']); ?></td>
            <td data-label="Impact Finances Choix 1"><?php echo htmlspecialchars($card['valeurs_finances_choix1']); ?></td>
            <td data-label="Impact Population Choix 2"><?php echo htmlspecialchars($card['valeurs_population_choix2']); ?></td>
            <td data-label="Impact Finances Choix 2"><?php echo htmlspecialchars($card['valeurs_finances_choix2']); ?></td>
            <td data-label="Date de Soumission"><?php echo htmlspecialchars($card['date_soumission']); ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>

                </table>
            </div>
            <a href="/EasyCrea/public/index.php?url=dashboard">Retour</a>
        <?php else: ?>
            <p>Aucune carte n'a été créée pour ce deck.</p>
        <?php endif; ?>
    </main>
</body>
</html>
