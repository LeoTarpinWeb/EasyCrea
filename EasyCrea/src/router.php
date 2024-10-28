<?php
class Router {
    public function route() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Récupère l'URL de la requête
        $url = $_GET['url'] ?? '';

        //Tableau de routes
        $routes = [
            '' => ['HomeController', 'index'], // Accueil
            'login' => ['ConnexionController', 'login'], // Connexion
            'logout' => ['ConnexionController', 'logout'], // Déconnexion
            'register' => ['ConnexionController', 'register'], // Inscription
            'dashboard' => ['AdminController', 'dashboard'], // Dashboard Admin
            'submit' => ['CreateurController', 'accueil'], // Accueil Créateur
            'createDeck' => ['AdminController', 'createDeck'], // Création de deck
            'saveDeck' => ['AdminController', 'saveDeck'], // Sauvegarde du deck
            'addCard' => ['CarteController', 'addCard'], // Ajout de carte
            'saveCard' => ['CarteController', 'saveCard'], // Sauvegarde de carte
            'viewDeckCards' => ['AdminController', 'viewDeckCards'], // Voir les cartes d'un deck
        ];

        if (array_key_exists($url, $routes)) {
            $this->dispatch($routes[$url]);
        } else {
            $controller = new ErrorController();
            $controller->notFound();
            
        }
    }

    private function dispatch($route) {
        list($controllerName, $method) = $route;

        $controller = new $controllerName();

        if ($controllerName === 'AdminController' && !isset($_SESSION['admin_id'])) {
            header('Location: /EasyCrea/public/index.php?url=login');
            exit;
        }

        if ($controllerName === 'CreateurController' && !isset($_SESSION['createur_id'])) {
            header('Location: /EasyCrea/public/index.php?url=login');
            exit;
        }

        if (method_exists($controller, $method)) {
            $controller->$method();
        } else {
            $errorController = new ErrorController();
            $errorController->notFound();
        }
    }
}
