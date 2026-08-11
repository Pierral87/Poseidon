<?php 

/* 

--- TP Jour 2 : Gestion des Emprunts & Sécurité (Middleware) ---


--- Objectif du TP
La structure de la table pivot loans et ses relations Eloquent étant déjà en place, l'objectif est d'en faire un module fonctionnel complet.

Vous allez construire le contrôleur LoanController pour gérer le cycle de vie d'un emprunt (emprunter un livre, le marquer comme rendu), et sécuriser l'accès à ces fonctionnalités via un Middleware personnalisé.



--- Étapes à réaliser


- Étape 1 : Jeux d'essais (LoanFactory & LoanSeeder)
Le modèle Loan étant prêt, automatisez la création d'emprunts de démonstration :
    LoanFactory.php : Configurez la factory pour générer des emprunts.

        user_id et book_id doivent pointer vers des enregistrements existants.

        borrowed_at doit générer une date passée (ex: entre il y a 1 mois et aujourd'hui).

        returned_at doit être aléatoirement null (emprunt en cours) ou contenir une date de retour valide.

    LoanSeeder.php : Générez une vingtaine d'emprunts de test.

    DatabaseSeeder.php : Ajoutez LoanSeeder::class à la suite de vos seeders d'utilisateurs et de livres.


- Étape 2 : Le Contrôleur LoanController
Implémentez la logique métier dans LoanController.php :

    index() : Récupérez les emprunts avec Eager Loading (with(['user', 'book'])) triés du plus récent au plus ancien.

    create() : Récupérez la liste des utilisateurs et la liste des livres disponibles (Bonus : ceux qui n'ont pas d'emprunt en cours avec returned_at à null).

    store(Request $request) :

        Validez la requête (user_id et book_id obligatoires et existants).

        (Bonus : Vérifiez la règle métier : s'assurer que le livre n'est pas déjà en cours d'emprunt avant de valider.)

        Enregistrez l'emprunt avec borrowed_at à la date du jour.

    update(Request $request, Loan $loan) :

        Implémentez l'action de retour de livre : mettez à jour le champ returned_at avec la date du jour (now()).


- Étape 3 : Gestion des Rôles 
Configurez les autorisations d'accès :

    Dans votre seeder de rôles/permissions, créez les rôles Administrateur et Staff.

    Attribuez le rôle Staff à au moins un utilisateur de test.

    Seuls les utilisateurs possédant le rôle admin ou staff doivent pouvoir gérer les emprunts.


- Étape 4 : Middleware Personnalisé EnsureUserIsStaff
Créez une couche de sécurité sur mesure pour verrouiller les routes d'emprunt :

    Générez le middleware : php artisan make:middleware EnsureUserIsStaff.

    Dans la méthode handle(), vérifiez si l'utilisateur connecté est authentifié et possède le rôle admin OU staff.

    Si la condition n'est pas remplie, interrompez la requête (erreur HTTP 403 Forbidden ou redirection avec message d'erreur).

    Enregistrez votre middleware dans l'application (bootstrap/app.php).

    Appliquez ce middleware à l'ensemble du groupe de routes /loans.

- Étape 5 : Vues Blade (loans/index & loans/create)
Créez l'interface d'administration des emprunts :

    loans/index.blade.php :

        Tableau listant : Nom de l'emprunteur, Titre du livre, Date d'emprunt, Statut.

        Badge de couleur pour le statut : Vert ("En cours") si returned_at est null, Gris ("Rendu le DD/MM/YYYY") sinon.

        Pour les emprunts en cours, affichez un bouton/formulaire pour "Marquer comme rendu".

    loans/create.blade.php :

        Formulaire avec sélection d'un utilisateur et d'un livre disponible.

*/