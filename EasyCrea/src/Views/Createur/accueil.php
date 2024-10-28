<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Créateur - EasyCrea</title>
    <link rel="stylesheet" href="/EasyCrea/public/css/style.css">
</head>
<body>
    <header>
        <h1>Bienvenue sur l'Accueil du Créateur</h1>
        <nav>
            <a href="/EasyCrea/public/index.php?url=logout">Déconnexion</a>
        </nav>
    </header>

    <div class="container">
        <h1>Vos decks</h1>

        <?php if (!empty($decks)): ?>
            <?php foreach ($decks as $deck): ?>
                <div class="deck">
                    <h2><?php echo htmlspecialchars($deck['titre_deck']); ?></h2>

                    <?php if ($deck['random_card']): ?>
                        <div class="random-card">
                            <h3>Carte aléatoire dans ce deck :</h3>
                            <p><strong>Texte :</strong> <?php echo htmlspecialchars($deck['random_card']['texte_carte']); ?></p>
                            <p><strong>Population Choix 1 :</strong>
                                <?php echo htmlspecialchars($deck['random_card']['valeurs_population_choix1']); ?></p>
                            <p><strong>Finances Choix 1 :</strong>
                                <?php echo htmlspecialchars($deck['random_card']['valeurs_finances_choix1']); ?></p>
                            <p><strong>Population Choix 2 :</strong>
                                <?php echo htmlspecialchars($deck['random_card']['valeurs_population_choix2']); ?></p>
                            <p><strong>Finances Choix 2 :</strong>
                                <?php echo htmlspecialchars($deck['random_card']['valeurs_finances_choix2']); ?></p>
                        </div>
                    <?php else: ?>
                        <p>Aucune carte disponible pour ce deck.</p>
                    <?php endif; ?>

                    <?php if ($deck['created_card']): ?>
                        <div class="created-card">
                            <h3>Votre carte dans ce deck :</h3>
                            <p><strong>Texte :</strong> <?php echo htmlspecialchars($deck['created_card']['texte_carte']); ?></p>
                            <p><strong>Population 1 :</strong>
                                <?php echo htmlspecialchars($deck['created_card']['valeurs_population_choix1']); ?></p>
                            <p><strong>Finances 1 :</strong>
                                <?php echo htmlspecialchars($deck['created_card']['valeurs_finances_choix1']); ?></p>
                            <p><strong>Population Choix 2 :</strong>
                                <?php echo htmlspecialchars($deck['created_card']['valeurs_population_choix2']); ?></p>
                            <p><strong>Finances Choix 2 :</strong>
                                <?php echo htmlspecialchars($deck['created_card']['valeurs_finances_choix2']); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($deck['nb_cartes_crees'] < $deck['nb_cartes']): ?>
                        <?php if (!$deck['created_card']): ?>
                            <form action="/EasyCrea/public/index.php?url=saveCard" method="POST">
                                <input type="hidden" name="deck_id" value="<?php echo $deck['id_deck']; ?>">

                                <label for="texte_carte">Texte de la Carte (entre 50 et 280 caractères):</label>
                                <textarea id="texte_carte" name="texte_carte" required minlength="50" maxlength="280"></textarea>

                                <label for="pop_choice1">Impact Population (Choix 1) :</label>
                                <input type="number" id="pop_choice1" name="pop_choice1" required>

                                <label for="fin_choice1">Impact Finances (Choix 1) :</label>
                                <input type="number" id="fin_choice1" name="fin_choice1" required>

                                <label for="pop_choice2">Impact Population (Choix 2) :</label>
                                <input type="number" id="pop_choice2" name="pop_choice2" required>

                                <label for="fin_choice2">Impact Finances (Choix 2) :</label>
                                <input type="number" id="fin_choice2" name="fin_choice2" required>

                                <button type="submit">Créer la Carte</button>
                            </form>
                        <?php endif; ?>
                    <?php elseif (!$deck['created_card']): ?>
                        <p class="error-message">Le deck est plein, vous ne pouvez pas ajouter de carte.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune création de deck en cours.</p>
        <?php endif; ?>

    </div>
</body>
</html>
