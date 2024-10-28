<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/config/config.php';

class AdminController {

    //Dashboard de l'administrateur
    public function dashboard() {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /EasyCrea/public/index.php?url=login');
            exit;
        }

        $adminModel = new AdminModel();
        $decks = $adminModel->getAllDecks();

        require_once $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/Views/Admin/dashboard.php';
    }

    //Formulaire de création de deck
    public function createDeck() {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /EasyCrea/public/index.php?url=login');
            exit;
        }

        require_once $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/Views/Admin/create_deck.php';
    }

//Sauvegarder un deck dans la base de données
public function saveDeck() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['admin_id'])) {
        $titre_deck = $_POST['titre_deck'];
        $date_debut_deck = $_POST['date_debut_deck'];
        $date_fin_deck = $_POST['date_fin_deck'];
        $nb_cartes = $_POST['nb_cartes'];

        if ($nb_cartes < 1) {
            $_SESSION['error_message'] = "Un deck doit avoir au moins 1 carte.";
            header('Location: /EasyCrea/public/index.php?url=createDeck');
            exit;
        }
        $adminModel = new AdminModel();
        $adminModel->createDeck($titre_deck, $date_debut_deck, $date_fin_deck, $nb_cartes);

        header('Location: /EasyCrea/public/index.php?url=dashboard');
        exit;
    } else {
        header('Location: /EasyCrea/public/index.php?url=login');
        exit;
    }
}

    //Voir les cartes d'un deck
    public function viewDeckCards() {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /EasyCrea/public/index.php?url=login');
            exit;
        }

        $deck_id = $_GET['deck_id'] ?? null;
        if ($deck_id) {
            $adminModel = new AdminModel();
            $cards = $adminModel->getDeckCards($deck_id); 

            require_once $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/Views/Admin/view_deck_cards.php';
        } else {
            header('Location: /EasyCrea/public/index.php?url=dashboard');
            exit;
        }
    }
}
