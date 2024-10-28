    <?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/config/config.php';

    class AdminModel {
        private $db;

        public function __construct() {
            $this->db = DatabaseConfig::getConnection();
        }

        // Récupérer un administrateur
        public function getById($id) {
            $stmt = $this->db->prepare('SELECT * FROM administrateur WHERE id_administrateur = :id');
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        }

        // Vérifier l'email et le mot de passe de l'administrateur
        public function getByEmailAndPassword($email, $password) {
            // On prépare la requête pour récupérer l'administrateur par email
            $stmt = $this->db->prepare('SELECT * FROM administrateur WHERE email_admin = :email');
            $stmt->execute(['email' => $email]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['mdp_admin'])) {
                return $admin; 
            }

            return null;
        }

        // Récupérer tous les decks
        public function getAllDecks() {
            $stmt = $this->db->prepare('SELECT * FROM deck ORDER BY date_debut_deck DESC');
            $stmt->execute();
            return $stmt->fetchAll();
        }

        // Créer un nouveau deck
        public function createDeck($titre_deck, $date_debut_deck, $date_fin_deck, $nb_cartes) {
            $stmt = $this->db->prepare('
                INSERT INTO deck (titre_deck, date_debut_deck, date_fin_deck, nb_cartes, en_creation) 
                VALUES (:titre_deck, :date_debut_deck, :date_fin_deck, :nb_cartes, 1)
            ');
            $stmt->execute([
                'titre_deck' => $titre_deck,
                'date_debut_deck' => $date_debut_deck,
                'date_fin_deck' => $date_fin_deck,
                'nb_cartes' => $nb_cartes,
            ]);
        }

        // Récupérer toutes les cartes d'un deck
        public function getDeckCards($deck_id) {
            $stmt = $this->db->prepare('SELECT * FROM carte WHERE id_deck = :deck_id ORDER BY date_soumission DESC');
            $stmt->execute(['deck_id' => $deck_id]);
            return $stmt->fetchAll();
        }
    }
