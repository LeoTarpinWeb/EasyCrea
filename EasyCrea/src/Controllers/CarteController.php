<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/config/config.php';

class CarteController {

    //Formulaire pour ajouter une carte
    public function addCard() {
        if (!isset($_SESSION['admin_id']) && !isset($_SESSION['createur_id'])) {
            header('Location: /EasyCrea/public/index.php?url=login');
            exit;
        }

        $deck_id = $_GET['deck_id'] ?? null;

        if (!$deck_id) {
            header('Location: /EasyCrea/public/index.php?url=dashboard');
            exit;
        }

        $carteModel = new CarteModel();
        $deckInfo = $carteModel->getDeckInfo($deck_id); 

        if ($deckInfo['nb_cartes_crees'] >= $deckInfo['nb_cartes']) {
            echo "Le deck est déjà plein. Vous ne pouvez pas ajouter de carte.";
            exit;
        }

        if ($carteModel->hasCreatedCard($deck_id)) {
            echo "Vous avez déjà créé une carte pour ce deck.";
            exit;
        }

        require_once $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/Views/add_card.php';
    }

    //Sauvegarde la carte dans la base de données
    public function saveCard() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_SESSION['admin_id']) || isset($_SESSION['createur_id']))) {
            $deck_id = $_POST['deck_id'];
            $texte_carte = $_POST['texte_carte'];
            $pop_choice1 = $_POST['pop_choice1'];
            $pop_choice2 = $_POST['pop_choice2'];
            $fin_choice1 = $_POST['fin_choice1'];
            $fin_choice2 = $_POST['fin_choice2'];

            $carteModel = new CarteModel();

            $deckInfo = $carteModel->getDeckInfo($deck_id);

            if ($deckInfo['nb_cartes_crees'] >= $deckInfo['nb_cartes']) {
                echo "Le deck est déjà plein. Vous ne pouvez pas ajouter de carte.";
                exit;
            }

            if ($carteModel->hasCreatedCard($deck_id)) {
                echo "Vous avez déjà créé une carte pour ce deck.";
                exit;
            }

            $carteModel->createCard($deck_id, $texte_carte, $pop_choice1, $pop_choice2, $fin_choice1, $fin_choice2);

            header("Location: /EasyCrea/public/index.php?url=dashboard");
            exit;
        } else {
            header('Location: /EasyCrea/public/index.php?url=login');
            exit;
        }
    }
}
