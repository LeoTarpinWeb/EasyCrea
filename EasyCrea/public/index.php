<?php
session_start();

// Autoloader pour charger les classes automatiquement
spl_autoload_register(function ($class) {
    // Construit le chemin du fichier de la classe à partir du nom de la classe
    $controllerPath = $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/Controllers/' . $class . '.php';
    $modelPath = $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/Models/' . $class . '.php';

    if (file_exists($controllerPath)) {
        require_once $controllerPath;
    } elseif (file_exists($modelPath)) {
        require_once $modelPath;
    }
});

// Ajout d'un message pour vérifier le chemin du fichier
$routerPath = __DIR__ . '/../src/router.php';
if (file_exists($routerPath)) {
    require_once $routerPath;
} else {
    // Affiche un message d'erreur avec le chemin exact
    die("Fichier Router.php introuvable à l'emplacement : $routerPath");
}

$router = new Router();
$router->route();
