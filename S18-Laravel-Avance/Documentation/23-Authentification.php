<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 23 - Authentification avec Laravel
----------------------------------------------------------------------------

--- Pourquoi l'authentification existe ?
Dans une application web, certaines fonctionnalités ne doivent être accessibles qu'à des utilisateurs identifiés.

Par exemple, dans notre application de gestion de bibliothèque :

un visiteur peut consulter les livres disponibles ;
un utilisateur connecté peut emprunter un livre ;
un administrateur peut ajouter ou supprimer des livres.

Avant de savoir ce qu'un utilisateur a le droit de faire, il faut d'abord savoir qui il est.

C'est le rôle de l'authentification.

L'authentification consiste à vérifier l'identité d'un utilisateur, généralement à l'aide d'une adresse e-mail et d'un mot de passe.

Une fois l'identité vérifiée, Laravel conserve cette information grâce à une session, ce qui permet à l'utilisateur de rester connecté lorsqu'il navigue dans l'application.

--- Authentification et autorisation
Il est important de distinguer deux notions souvent confondues.

    -- L'authentification
L'authentification répond à la question :
Qui êtes-vous ?
Laravel vérifie que l'adresse e-mail et le mot de passe correspondent bien à un utilisateur enregistré.
Si c'est le cas, l'utilisateur est connecté.

    -- L'autorisation
L'autorisation répond à une autre question :
Avez-vous le droit d'effectuer cette action ?
Par exemple, un utilisateur connecté peut être autorisé à modifier son propre profil, mais pas celui d'un autre utilisateur.
Les autorisations seront étudiées dans un chapitre suivant à l'aide des Gates, des Policies et de la gestion des rôles.

--- Le fonctionnement de l'authentification
Lorsqu'un utilisateur saisit son adresse e-mail et son mot de passe, Laravel procède aux étapes suivantes :

Les informations sont envoyées au serveur.
Laravel recherche l'utilisateur correspondant dans la base de données.
Le mot de passe fourni est comparé au mot de passe enregistré (haché).
Si les informations sont correctes, Laravel crée une session.
Lors des requêtes suivantes, cette session permet d'identifier automatiquement l'utilisateur connecté.

Ainsi, il n'est pas nécessaire de se reconnecter à chaque changement de page.

--- Les helpers Auth
Laravel fournit plusieurs méthodes permettant de connaître l'état de l'authentification.

    Auth::check()
Retourne true si un utilisateur est connecté.
if (Auth::check()) {
    // Un utilisateur est connecté
}

    Auth::user()
Retourne l'utilisateur actuellement connecté.
$user = Auth::user();
Cette méthode permet d'accéder à toutes les informations de l'utilisateur.

    Auth::id()
Retourne uniquement l'identifiant de l'utilisateur connecté.
$id = Auth::id();

    Auth::logout()
Déconnecte l'utilisateur en supprimant sa session.
Auth::logout();

    Auth::attempt() 
Nous permet de tenter une connexion par exemple : 
Auth::attempt(["email" => "pierra@mail.com", "password" => "password"]);


--- Laravel Breeze
Créer un système d'authentification complet demande beaucoup de travail :
formulaire d'inscription ;
formulaire de connexion ;
validation des données ;
hachage des mots de passe ;
gestion des sessions ;
réinitialisation du mot de passe ;
vérification d'adresse e-mail ;
protection des routes.

Pour éviter de recréer tout ce code à chaque projet, Laravel propose plusieurs packages officiels.

Le plus simple est Laravel Breeze.

Breeze génère automatiquement :
les routes ;
les contrôleurs ;
les vues Blade ;
les formulaires ;
la logique de connexion et de déconnexion.

Il ne remplace pas Laravel : il utilise simplement les fonctionnalités natives du framework pour produire une base de travail prête à l'emploi.


--- Installation de Breeze : 
composer require laravel/breeze --dev
php artisan breeze:install


--- Les principales fonctionnalités de Breeze
Une fois installé, Breeze fournit plusieurs fonctionnalités essentielles.

    -- Register
Permet à un nouvel utilisateur de créer un compte.
Les informations sont validées avant l'enregistrement.
Le mot de passe est automatiquement haché avant d'être enregistré dans la base de données.

    -- Login
Permet à un utilisateur existant de se connecter.
Si les informations sont correctes, Laravel crée une session et l'utilisateur devient authentifié.

    -- Logout
Permet de mettre fin à la session.
L'utilisateur est alors déconnecté et doit saisir à nouveau ses identifiants pour accéder aux pages protégées.

    -- Password Reset
Laravel permet de réinitialiser un mot de passe oublié.
Le fonctionnement repose sur plusieurs étapes :
génération d'un lien sécurisé ;
envoi par e-mail ;
vérification du lien ;
choix d'un nouveau mot de passe.
Cette fonctionnalité est directement intégrée à Breeze.

    -- Vérification d'adresse e-mail
Certaines applications souhaitent vérifier que l'utilisateur possède réellement l'adresse e-mail utilisée lors de son inscription.
Laravel permet d'envoyer automatiquement un lien de confirmation.
L'utilisateur devra cliquer sur ce lien avant d'accéder à certaines fonctionnalités de l'application.


--- Les sessions
Lorsque l'authentification réussit, Laravel crée automatiquement une session.
Une session est un espace de stockage temporaire associé à un utilisateur.

Elle permet notamment de mémoriser :
l'identifiant de l'utilisateur connecté ;
certaines informations de navigation ;
les messages temporaires (flash messages).

Grâce à cette session, Laravel est capable de retrouver automatiquement l'utilisateur lors de chaque requête.


--- Ce qu'il faut retenir
L'authentification permet d'identifier un utilisateur.
L'autorisation permet de savoir ce qu'il est autorisé à faire.
Laravel utilise des sessions pour conserver l'utilisateur connecté.
Les helpers Auth permettent de récupérer facilement les informations de connexion.
Laravel Breeze génère une authentification complète basée sur les fonctionnalités natives de Laravel.
Breeze facilite le développement mais n'ajoute pas un nouveau système d'authentification.


--- Les bonnes pratiques
Toujours utiliser les outils d'authentification proposés par Laravel.
Ne jamais enregistrer un mot de passe en clair dans la base de données.
Utiliser des mots de passe suffisamment robustes.
Déconnecter correctement l'utilisateur avec Auth::logout().
Protéger les pages sensibles grâce aux middlewares d'authentification.


--- Les erreurs fréquentes
Confondre authentification et autorisation.
Penser que Breeze remplace le système d'authentification de Laravel.
Manipuler directement les mots de passe sans utiliser le système de hachage de Laravel.
Tenter de créer un système de connexion entièrement personnalisé alors que Laravel fournit déjà toutes les fonctionnalités nécessaires.
Oublier que l'utilisateur connecté est conservé grâce à la session.


*/