<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - EasyCrea</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <header>
        <h1>Inscription</h1>
        <nav>
            <a href="/EasyCrea/public/index.php">Accueil</a> |
            <a href="/EasyCrea/public/index.php?url=login">Se connecter</a> |
        </nav>
    </header>

    <main>
        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']); 
        }
        ?>
        
        <form action="/EasyCrea/public/index.php?url=register" method="POST">
            <label for="nom_createur">Nom de créateur :</label>
            <input type="text" id="nom_createur" name="nom_createur" required>

            <label for="email_createur">Adresse Email :</label>
            <input type="email" id="email_createur" name="email_createur" required>

            <label for="mdp_createur">Mot de passe :</label>
            <input type="password" id="mdp_createur" name="mdp_createur" required>

            <label for="genre">Genre :</label>
            <select id="genre" name="genre" required>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
                <option value="autres">Autres</option>
            </select>

            <label for="ddn">Date de naissance :</label>
            <input type="date" id="ddn" name="ddn" required>

            <button type="submit">S'inscrire</button>
        </form>
    </main>
</body>
</html>
