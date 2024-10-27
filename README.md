# EasyCrea
SAE MMI S5

Voici un modèle de document spécifiant les consignes d’utilisation pour ton projet EasyCrea, en tenant compte de toutes les spécifications que tu as fournies jusqu'à présent.

---

## Document de Consignes d’Utilisation - EasyCrea

### Accès à la Plateforme

#### 1. Création d'un Compte

- Chaque utilisateur doit créer un compte pour accéder à la plateforme et soumettre une carte.
- Lors de la création d'un compte, l’utilisateur doit choisir un identifiant unique (pseudo) et un mot de passe.
- Si l'identifiant est déjà pris, un message d'erreur s’affiche : "**Le pseudo est déjà utilisé.**"
- L’utilisateur doit fournir les informations suivantes lors de l'inscription :
  - **Nom d’utilisateur (pseudo)** : Unique pour chaque utilisateur.
  - **Email** 
  - **Mot de passe** 
  - **Genre** 
  - **Date de naissance** 

#### 2. Connexion à la Plateforme

- Pour accéder à son espace personnel, l’utilisateur doit entrer son **identifiant** et son **mot de passe**.
- Une fois connecté, l’utilisateur est dirigé vers la page d’accueil du créateur.

#### 3. Déconnexion

- L’utilisateur peut se déconnecter de la plateforme à tout moment en cliquant sur le lien **Déconnexion** dans le menu de navigation de l’en-tête.

### Utilisation de la Plateforme

#### 1. Accueil du Créateur

- Une fois connecté, l’utilisateur accède à la liste des decks disponibles :
  - **Si aucun deck n’est en cours de création** : Le message suivant s’affiche : "**Aucune création de deck en cours.**"
  - **Si un deck est en cours de création** : La liste des cartes du deck est affichée.

#### 2. Soumission d’une Carte

- Un créateur peut soumettre une carte pour le deck en cours en remplissant un formulaire avec les informations suivantes :
  - **Texte de la carte** (entre 50 et 280 caractères).
  - **Impact Population** pour le choix 1 (valeur entière).
  - **Impact Finances** pour le choix 1 (valeur entière).
  - **Impact Population** pour le choix 2 (valeur entière).
  - **Impact Finances** pour le choix 2 (valeur entière).
  
- Chaque créateur peut soumettre **une seule carte** par deck :
  - **Si la carte a déjà été soumise** : La carte est affichée sous la section "**Votre carte dans ce deck**".
  - **Si le deck est plein** : Un message s'affiche indiquant que le deck est complet, et aucune autre carte ne peut être ajoutée.

#### 3. Modération des Cartes

- Les administrateurs peuvent consulter chaque carte soumise d'un deck.
  
#### 4. Affichage des Cartes du Deck

- La carte affichée change aléatoirement pour chaque utilisateur, pour offrir une expérience unique.
- Les cartes sont affichées de manière ordonnée avec la date de soumission.



