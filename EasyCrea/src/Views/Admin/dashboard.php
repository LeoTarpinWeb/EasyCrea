<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - EasyCrea</title>
    <link rel="stylesheet" href="/EasyCrea/public/css/style.css">
</head>
<body>
    <header>
        <h1>Tableau de bord de l'Administrateur</h1>
        <nav>
            <a href="/EasyCrea/public/index.php?url=logout">Déconnexion</a>
        </nav>
    </header>

    <main>
        <h2>Liste des Decks Créés</h2>

        <!-- Ajouter un bouton pour créer un nouveau deck -->
        <button onclick="window.location.href='/EasyCrea/public/index.php?url=createDeck'">Créer un Nouveau Deck</button>

        <!-- Liste des decks -->
        <?php if (!empty($decks)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Titre du Deck</th>
                        <th>Date de Fin</th>
                        <th>Nombre de Cartes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($decks as $deck): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($deck['titre_deck']); ?></td>
                            <td><?php echo htmlspecialchars($deck['date_fin_deck']); ?></td>
                            <td><?php echo htmlspecialchars($deck['nb_cartes']); ?></td>
                            <td>
                                <?php 
                                $carteModel = new CarteModel();
                                if (!$carteModel->hasCreatedCard($deck['id_deck'])): ?>
                                    <a href="/EasyCrea/public/index.php?url=addCard&deck_id=<?php echo $deck['id_deck']; ?>">Ajouter une carte</a> |
                                <?php endif; ?>
                                <a href="/EasyCrea/public/index.php?url=viewDeckCards&deck_id=<?php echo $deck['id_deck']; ?>">Voir les cartes</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun deck n'a été créé.</p>
        <?php endif; ?>
    </main>
</body>
</html>
