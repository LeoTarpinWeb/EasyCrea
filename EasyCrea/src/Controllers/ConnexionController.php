<?php

class ConnexionController {
    public function __construct() {
        // Démarre la session si ce n'est pas déjà fait
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function loadView($viewName) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/EasyCrea/src/Views/' . $viewName;
    }
    
    // Se connecter
    public function login() {
        if (isset($_SESSION['admin_id'])) {
            header('Location: /EasyCrea/public/dashboard');
            exit;
        } elseif (isset($_SESSION['createur_id'])) {
            header('Location: /EasyCrea/public/submit');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $adminModel = new AdminModel();
            $admin = $adminModel->getByEmailAndPassword($email, $password);

            if ($admin) {
                $_SESSION['admin_id'] = $admin['id_administrateur'];
                header('Location: /EasyCrea/public/dashboard');
                exit;
            }

            $createurModel = new CreateurModel();
            $createur = $createurModel->getByEmailAndPassword($email, $password);

            if ($createur) {
                $_SESSION['createur_id'] = $createur['id_createur'];
                header('Location: /EasyCrea/public/submit');
                exit;
            }

            $_SESSION['error_message'] = "Identifiant ou mot de passe incorrects.";
            header('Location: /EasyCrea/public/index.php?url=login'); 
            exit;
        } else {
            $this->loadView('login.php');
        }
    }

    // S'enregistrer
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom_createur'];
            $email = $_POST['email_createur'];
            $password = $_POST['mdp_createur'];
            $genre = $_POST['genre'];
            $ddn = $_POST['ddn'];
    
            // Validation du mot de passe
            if (!preg_match('/^(?=.*[0-9])(?=.*[\W]).{6,}$/', $password)) {
                $_SESSION['error_message'] = "Le mot de passe doit contenir au moins 6 caractères, un chiffre et un caractère spécial.";
                header('Location: /EasyCrea/public/index.php?url=register');
                exit;
            }
    
            // Hachage du mot de passe après validation
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
            $createurModel = new CreateurModel();
    
            // Vérifier si le nom de créateur existe déjà
            if ($createurModel->nameExists($nom)) {
                $_SESSION['error_message'] = "Ce nom de créateur est déjà utilisé. Veuillez en choisir un autre.";
                header('Location: /EasyCrea/public/index.php?url=register');
                exit;
            }
    
            // Créer le créateur
            $createurModel->create($nom, $email, $hashedPassword, $genre, $ddn);
    
            // Redirection vers la page de connexion
            header('Location: /EasyCrea/public/index.php?url=login');
            exit;
        } else {
            $this->loadView('register.php');
        }
    }
    
    
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /EasyCrea/public/index.php');
        exit;
    }
}
