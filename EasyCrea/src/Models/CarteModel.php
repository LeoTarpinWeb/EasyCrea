<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/config/config.php';

class CarteModel {

    private $db;

    public function __construct() {
        $this->db = DatabaseConfig::getConnection();
    }

    // Vérifier si l'utilisateur a déjà créé une carte pour un deck spécifique
    public function hasCreatedCard($deck_id) {
        if (isset($_SESSION['admin_id'])) {
            $stmt = $this->db->prepare('SELECT COUNT(*) FROM carte WHERE id_deck = :deck_id AND id_administrateur = :admin_id');
            $stmt->execute(['deck_id' => $deck_id, 'admin_id' => $_SESSION['admin_id']]);
        }
        elseif (isset($_SESSION['createur_id'])) {
            $stmt = $this->db->prepare('SELECT COUNT(*) FROM carte WHERE id_deck = :deck_id AND id_createur = :createur_id');
            $stmt->execute(['deck_id' => $deck_id, 'createur_id' => $_SESSION['createur_id']]);
        }
        
        return $stmt->fetchColumn() > 0;
    }

    // Insérer une nouvelle carte
    public function createCard($deck_id, $texte_carte, $pop_choice1, $pop_choice2, $fin_choice1, $fin_choice2) {
        if (strlen($texte_carte) < 50 || strlen($texte_carte) > 280) {
            throw new Exception("Le texte de la carte doit contenir entre 50 et 280 caractères.");
        }

        $query = '
            INSERT INTO carte (texte_carte, valeurs_population_choix1, valeurs_population_choix2, valeurs_finances_choix1, valeurs_finances_choix2, id_administrateur, id_createur, date_soumission, id_deck)
            VALUES (:texte_carte, :pop_choice1, :pop_choice2, :fin_choice1, :fin_choice2, :id_administrateur, :id_createur, NOW(), :deck_id)
        ';
    
        $stmt = $this->db->prepare($query);

        $stmt->execute([
            'texte_carte' => $texte_carte,
            'pop_choice1' => $pop_choice1,
            'pop_choice2' => $pop_choice2,
            'fin_choice1' => $fin_choice1,
            'fin_choice2' => $fin_choice2,
            'id_administrateur' => $_SESSION['admin_id'] ?? null,
            'id_createur' => $_SESSION['createur_id'] ?? null,
            'deck_id' => $deck_id,
        ]);
    }
    public function getDeckInfo($deck_id) {

        $query = '
            SELECT nb_cartes, 
                   (SELECT COUNT(*) FROM carte WHERE id_deck = :deck_id) AS nb_cartes_crees
            FROM deck 
            WHERE id_deck = :deck_id
        ';

        $stmt = $this->db->prepare($query);
        $stmt->execute(['deck_id' => $deck_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

