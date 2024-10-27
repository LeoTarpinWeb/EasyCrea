<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - EasyCrea</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <header>
        <h1>Connexion</h1>
        <nav>
        <a href="/EasyCrea/public/index.php">Accueil</a> |
        <a href="/EasyCrea/public/index.php?url=register">S'inscrire</a>
        </nav>
    </header>

    <main>
    <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message">
                <p><?php echo $_SESSION['error_message']; ?></p>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
        
        <form action="/EasyCrea/public/index.php?url=login" method="POST">
            <label for="email">Adresse Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Se connecter</button>
        </form>
    </main>
</body>
</html>
