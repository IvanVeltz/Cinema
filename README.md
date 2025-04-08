# CINEMA

## 📝 Description
Ce projet est une application web de gestion de films utilisant le **design pattern MVC** (*Model-View-Controller*). 
L'application permet de gérer un ensemble de films, d'acteurs, de réalisateurs et de catégories. 
Elle offre des fonctionnalités complètes comme l'ajout, la modification, la suppression d'entités.

## 🚀 Fonctionnalités
- **Gestion des Films :**
  - Ajouter un nouveau film avec un titre, une année de sortie, une durée, un synopsis, une affiche, un réalisateur, une note
  - Modifier les informations d'un film existant.
  - Supprimer un film.

- **Gestion des Acteurs et Réalisateurs :**
  - Liste les acteurs et réalisateurs présent en base de données.
  - Ajouter, modifier et supprimer des acteurs et des réalisateurs.

- **Catégories :**
  - Affiche les films selon la catégorie choisi.
  - Ajouter, Supprimer une catégorie.
 
- **Casting :**
  - Ajouter un rôle.
  - Attribuer un rôle à un acteur dans un film précis.
  - Suppression de rôle.
  
- **Téléchargement d'images :**
  - Uploader une image pour chaque film lors de sa création.
 
## 🛠️ Technologies Utilisées
- **HTML/CSS** : Structure et design des pages.
- **PHP** : Langage principal pour le backend.
- **MySQL** : Gestion de la base de données.
- **JavaScript** : Pour des interactions utilisateur (Affichage de formulaire, menu "burger").
  

## 📂 Structure du projet
- **Pattern MVC** :
  - `index.php` : Point d'entrée unique pour rediriger les requêtes vers le contrôleur approprié.
  - **Modèles** : Gestion des données et interaction avec la base de données.
  - **Vues** : Affichage des pages HTML dynamiques.
  - **Contrôleurs** : Gestion de la logique applicative et des interactions utilisateur.

## 🔧 Installation
1. Clonez ce dépôt sur votre machine locale :
   ```bash
   git clone https://github.com/IvanVeltz/Cinema.git
2. Installez un serveur web local (par ex. Laragon, XAMPP ou WAMP) et configurez une base de données MySQL.
3. Importez le fichier ```cinema-ivan.sql``` fourni dans votre base de données.
4. Assurez-vous que les informations de connexion à la base de données sont correctement configurées dans les fichiers nécessaires (par exemple, dans les modèles ou directement dans le code).

## 💻 Utilisation
1. Lancer le serveur local.
2. Accédez à l'application via ```htttp://localhost//nom-de-projet/index.php```.
3. Utilisez les fonctionnalités disponibles pour gérer les films, acteurs, réalisateurs et catégories.

## 👤 Auteur
VELTZ Ivan
