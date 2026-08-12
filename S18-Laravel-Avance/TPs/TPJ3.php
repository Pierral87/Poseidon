<?php 

/* 

--- TP Jour 3 : Form Requests, Gates, Policies & Rôles Fins (Spatie)


- Objectif du TP

Sécuriser en profondeur la gestion des Auteurs et des Livres.

Mettre en place des Form Requests pour valider proprement les données, utiliser les Gates pour restreindre les accès globaux, et créer une Policy afin d'appliquer des règles d'autorisation fines (par exemple : vérifier qui est le créateur d'une ressource avant d'autoriser sa suppression).


--- Etapes : 

- Étape 1 : Nettoyage et Validation via Form Request (AuthorRequest)
Déportez la logique de validation des auteurs du contrôleur vers une classe dédiée.

    Génération : Créez le Form Request php artisan make:request StoreAuthorRequest.

    Autorisation : Dans authorize(), autorisez la requête (ex: vérifier si l'utilisateur est connecté et est staff/admin).

    Règles : Définissez les règles dans rules() pour first_name, last_name, email (unique dans la table authors), et phone (optionnel).

    Contrôleur : Injectez AuthorRequest dans la méthode store de AuthorController à la place de Request $request.


- Étape 2 : Configuration des Rôles & Permissions Spatie
Affinez la hiérarchie de vos utilisateurs de démonstration dans RoleSeeder.

    S'assurer que les rôles Spatie existants sont bien en place : admin, staff (bibliothécaire) et user (abonné).

    Ajoutez un champ created_by (clé étrangère vers users, nullable) sur la table books via une nouvelle migration (ou dans la migration existante) afin d'identifier quel membre du personnel a ajouté le livre.


- Étape 3 : Restriction des accès par Gates / Middleware
Verrouillez l'accès complet aux modules de gestion.

    Sécurisez les groupes de routes /authors et /books pour que seuls les utilisateurs ayant le rôle admin ou staff puissent accéder aux vues de création, d'édition et de suppression.

    Les utilisateurs ayant le simple rôle user (les abonnés) doivent uniquement pouvoir consulter la liste publique des livres ou leur propre profil.


- Étape 4 : Autorisations fines avec BookPolicy
C'est ici que la logique métier personnalisée entre en jeu. Créez la policy pour les livres : php artisan make:policy BookPolicy --model=Book.

Implémentez les règles suivantes :

    update(User $user, Book $book) : Un admin ou un staff peut modifier n'importe quel livre.

    delete(User $user, Book $book) :

        L'admin a le droit de supprimer n'importe quel livre.

        Le staff (bibliothécaire) a le droit de supprimer un livre UNIQUEMENT S'IL EN EST LE CRÉATEUR ($book->created_by === $user->id).

    Appliquez cette Policy dans le BookController (via $this->authorize('delete', $book) ou Gate::authorize()) et masquez le bouton "Supprimer" dans la vue Blade si l'utilisateur n'a pas la permission.


- Étape 5 : Autorisations sur les Auteurs (AuthorPolicy)
Générez la policy pour les auteurs : php artisan make:policy AuthorPolicy --model=Author.

    delete(User $user, Author $author) :

        Seul un utilisateur ayant le rôle admin a le droit de supprimer un auteur de la base de données. Un membre du staff ne peut pas supprimer un auteur (afin d'éviter d'impacter les livres associés).

*/