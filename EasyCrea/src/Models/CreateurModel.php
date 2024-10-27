<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/config/config.php';


class CreateurModel {

    private $db;

    public function __construct() {
        $this->db = DatabaseConfig::getConnection();
    }

    //Récupérer les decks avec au moins une carte
    public function getDecksWithCards() {
        $stmt = $this->db->prepare('
        SELECT d.id_deck, d.titre_deck, d.date_debut_deck, d.date_fin_deck, d.nb_cartes, COUNT(c.id_carte) AS nb_cartes_crees
        FROM deck d
        LEFT JOIN carte c ON d.id_deck = c.id_deck
        WHERE d.date_fin_deck IS NULL OR d.date_fin_deck > NOW()
        GROUP BY d.id_deck
        HAVING nb_cartes_crees > 0
        ORDER BY d.date_debut_deck DESC
    ');
        $stmt->execute();
        return $stmt->fetchAll(); 
    }

    //Récupérer la carte du créateur pour un deck spécifique
    public function getCardForDeck($deck_id, $createur_id) {
        $stmt = $this->db->prepare('
            SELECT * FROM carte 
            WHERE id_deck = :deck_id AND id_createur = :createur_id
        ');
        $stmt->execute([
            'deck_id' => $deck_id,
            'createur_id' => $createur_id
        ]);
        return $stmt->fetch(); 
    }

    //Récupérer la carte aléatoire stockée pour un utilisateur dans un deck
    public function getStoredRandomCard($deck_id, $createur_id) {
        $stmt = $this->db->prepare('
            SELECT * FROM carte_aleatoire
            WHERE id_createur = :createur_id AND num_carte IN (SELECT id_carte FROM carte WHERE id_deck = :deck_id)
        ');
        $stmt->execute(['deck_id' => $deck_id, 'createur_id' => $createur_id]);
        $result = $stmt->fetch();

        if ($result) {
            $card_stmt = $this->db->prepare('SELECT * FROM carte WHERE id_carte = :num_carte');
            $card_stmt->execute(['num_carte' => $result['num_carte']]);
            return $card_stmt->fetch();
        }
        return null;
    }

    //Stocker une carte aléatoire pour un utilisateur dans un deck
    public function storeRandomCard($deck_id, $num_carte, $createur_id) {
        $stmt = $this->db->prepare('
            INSERT INTO carte_aleatoire (num_carte, id_createur)
            VALUES (:num_carte, :createur_id)
        ');
        $stmt->execute(['num_carte' => $num_carte, 'createur_id' => $createur_id]);
    }

    //Récupérer une carte aléatoire pour un utilisateur dans un deck
    public function getAndStoreRandomCard($deck_id, $createur_id) {
        $storedCard = $this->getStoredRandomCard($deck_id, $createur_id);
        if ($storedCard) {
            return $storedCard;
        }

        $randomCard = $this->getRandomCardFromDeck($deck_id);
        if ($randomCard) {
            $this->storeRandomCard($deck_id, $randomCard['id_carte'], $createur_id);
        }

        return $randomCard;
    }

    //Sélectionner une carte aléatoire d'un deck
    public function getRandomCardFromDeck($deck_id) {
        $stmt = $this->db->prepare('
            SELECT * FROM carte 
            WHERE id_deck = :deck_id 
            ORDER BY RAND() 
            LIMIT 1
        ');
        $stmt->execute(['deck_id' => $deck_id]);
        return $stmt->fetch(); 
    }

    //Récupérer un créateur par son ID
    public function getById($id) {
        $stmt = $this->db->prepare('SELECT * FROM createur WHERE id_createur = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(); 
    }

    //Récupérer tous les decks avec le nombre de cartes associées
    public function getAllDecks() {
        $stmt = $this->db->prepare('
            SELECT d.id_deck, d.titre_deck, d.date_debut_deck, d.date_fin_deck, d.nb_cartes, COUNT(c.id_carte) AS nb_cartes_crees
            FROM deck d
            LEFT JOIN carte c ON d.id_deck = c.id_deck
            GROUP BY d.id_deck
            ORDER BY d.date_debut_deck DESC
        ');
        $stmt->execute();
        return $stmt->fetchAll();  
    }

    //Vérifie si le nom de créateur existe déjà
    public function nameExists($nom) {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM createur WHERE nom_createur = :nom');
        $stmt->execute(['nom' => $nom]);
        return $stmt->fetchColumn() > 0; 
    }

    //Récupérer un créateur par email et mot de passe
    public function getByEmailAndPassword($email, $password) {
        $stmt = $this->db->prepare('SELECT * FROM createur WHERE email_createur = :email');
        $stmt->execute(['email' => $email]);
        $createur = $stmt->fetch();

        if ($createur && password_verify($password, $createur['mdp_createur'])) {
            return $createur;
        }
        return null;
    }

    //Créer un nouveau créateur dans la base de données
    public function create($nom, $email, $password, $genre, $ddn) {
        $stmt = $this->db->prepare('
            INSERT INTO createur (nom_createur, email_createur, mdp_createur, genre, ddn)
            VALUES (:nom, :email, :mdp, :genre, :ddn)
        ');

        $stmt->execute([
            'nom' => $nom,
            'email' => $email,
            'mdp' => $password,
            'genre' => $genre,
            'ddn' => $ddn
        ]);
    }
}
