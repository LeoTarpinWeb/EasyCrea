<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Nouveau Deck</title>
    <link rel="stylesheet" href="/EasyCrea/public/css/style.css">
</head>
<body>
    <header>
        <h1>Créer un Nouveau Deck</h1>
    </header>

    <main>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message">
                <p><?php echo $_SESSION['error_message']; ?></p>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <form action="/EasyCrea/public/index.php?url=saveDeck" method="POST">
            <label for="titre_deck">Titre du Deck :</label>
            <input type="text" id="titre_deck" name="titre_deck" required>

            <label for="date_debut_deck">Date de Début :</label>
            <input type="date" id="date_debut_deck" name="date_debut_deck" required>

            <label for="date_fin_deck">Date de Fin :</label>
            <input type="date" id="date_fin_deck" name="date_fin_deck">

            <label for="nb_cartes">Nombre de Cartes :</label>
            <input type="number" id="nb_cartes" name="nb_cartes" required min="2">

            <button type="submit">Créer le Deck</button>
        </form>
    </main>
</body>
</html>
