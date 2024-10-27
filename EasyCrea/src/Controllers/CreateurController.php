<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/config/config.php';

class CreateurController {

    //Page d'accueil
    public function accueil() {
        if (!isset($_SESSION['createur_id'])) {
            header('Location: /EasyCrea/public/index.php?url=login');
            exit;
        }

        $createurModel = new CreateurModel();
        $decks = $createurModel->getDecksWithCards();  
        $createur_id = $_SESSION['createur_id']; 


        foreach ($decks as $key => $deck) {
            $randomCard = $createurModel->getAndStoreRandomCard($deck['id_deck'], $createur_id);
            $decks[$key]['random_card'] = $randomCard; 

            $createdCard = $createurModel->getCardForDeck($deck['id_deck'], $createur_id);
            $decks[$key]['created_card'] = $createdCard; 
        }

        require_once $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/Views/Createur/accueil.php';
    }
}
