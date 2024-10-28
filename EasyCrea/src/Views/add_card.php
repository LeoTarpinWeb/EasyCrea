<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Carte - EasyCrea</title>
    <link rel="stylesheet" href="/EasyCrea/public/css/style.css">
</head>
<body>
    <header>
        <h1>Ajouter une Carte</h1>
    </header>
    <main>
        <form action="/EasyCrea/public/index.php?url=saveCard" method="POST">
            <input type="hidden" name="deck_id" value="<?php echo htmlspecialchars($_GET['deck_id']); ?>">

            <label for="texte_carte">Texte de la Carte (50 à 280 caractères) :</label>
            <textarea id="texte_carte" name="texte_carte" minlength="50" maxlength="280" required></textarea>

            <label for="pop_choice1">Impact Population (Choix 1) :</label>
            <input type="number" id="pop_choice1" name="pop_choice1" required>


            <label for="fin_choice1">Impact Finances (Choix 1) :</label>
            <input type="number" id="fin_choice1" name="fin_choice1" required>
            
            <label for="pop_choice2">Impact Population (Choix 2) :</label>
            <input type="number" id="pop_choice2" name="pop_choice2" required>

            <label for="fin_choice2">Impact Finances (Choix 2) :</label>
            <input type="number" id="fin_choice2" name="fin_choice2" required>

            <button type="submit">Ajouter la Carte</button>
        </form>
    </main>
</body>
</html>
