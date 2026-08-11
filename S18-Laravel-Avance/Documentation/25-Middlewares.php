<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 25 - Les Middlewares
----------------------------------------------------------------------------

--- Pourquoi les middlewares existent ?
Lorsqu'un utilisateur envoie une requête à une application Laravel, cette requête ne va pas directement jusqu'au contrôleur.

Avant d'atteindre le contrôleur, Laravel lui fait traverser plusieurs étapes de vérification.

Ces étapes sont réalisées par des middlewares.

Un middleware est un composant chargé d'intercepter une requête afin de vérifier, modifier ou bloquer son exécution avant qu'elle n'atteigne le contrôleur.

Grâce aux middlewares, il est possible par exemple de :
vérifier qu'un utilisateur est connecté ;
empêcher un utilisateur connecté d'accéder à la page de connexion ;
limiter l'accès à certaines parties de l'application ;
enregistrer des informations sur les requêtes ;
appliquer des règles de sécurité.

Les middlewares permettent ainsi de centraliser des traitements communs sans les répéter dans chaque contrôleur.


--- Le cycle d'une requête
Dans Laravel, une requête suit toujours le même parcours.

Navigateur
      │
      ▼
Route
      │
      ▼
Middleware(s)
      │
      ▼
Contrôleur
      │
      ▼
Modèle
      │
      ▼
Vue
      │
      ▼
Réponse envoyée au navigateur

Le middleware intervient donc avant l'exécution du contrôleur.

Si le middleware décide que la requête est autorisée, elle poursuit son chemin.

Dans le cas contraire, le middleware peut interrompre le traitement et renvoyer immédiatement une réponse, par exemple une redirection ou une erreur 403.


--- Les middlewares Laravel
Laravel fournit déjà plusieurs middlewares prêts à l'emploi.

Parmi les plus utilisés, on trouve :
Middleware	    Rôle
auth	        Autorise uniquement les utilisateurs connectés
guest	        Autorise uniquement les visiteurs non connectés
verified	    Vérifie que l'adresse e-mail est confirmée
throttle	    Limite le nombre de requêtes pour éviter les abus

Ces middlewares couvrent les besoins les plus courants d'une application.

Il est également possible de créer ses propres middlewares afin de répondre à des besoins spécifiques.

--- Les middlewares personnalisés
Lorsqu'aucun middleware fourni par Laravel ne répond au besoin de l'application, il est possible d'en créer un.
php artisan make:middleware

Un middleware personnalisé est une classe contenant une méthode handle().

Cette méthode reçoit la requête avant le contrôleur et décide si elle peut continuer son chemin.

Elle peut par exemple :
vérifier le rôle d'un utilisateur ;
contrôler une condition métier ;
rediriger vers une autre page ;
retourner une erreur.

Les middlewares personnalisés permettent de regrouper des règles communes dans un seul endroit du projet.


--- La méthode handle()
La méthode principale d'un middleware est handle().

Elle reçoit deux éléments importants :
la requête (Request) ;
le paramètre $next.

Le rôle de $next est de transmettre la requête à l'étape suivante.

Lorsque le middleware appelle :
return $next($request);

Laravel continue normalement l'exécution de la requête.

En revanche, si le middleware retourne une réponse avant cet appel (par exemple une redirection ou une erreur), le contrôleur ne sera jamais exécuté.

C'est cette méthode qui fait du middleware un véritable filtre.


--- La protection des routes
Les middlewares sont généralement associés aux routes.

Exemple :
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Dans cet exemple, la page /dashboard ne sera accessible qu'aux utilisateurs connectés.

Si un visiteur tente d'y accéder, Laravel le redirigera automatiquement vers la page de connexion.

Les middlewares permettent donc de protéger très facilement certaines parties de l'application.


--- Les groupes de middlewares
Lorsqu'un grand nombre de routes utilisent les mêmes middlewares, Laravel permet de les regrouper.

Exemple :
Route::middleware(['auth'])->group(function () {
    Route::resource('books', BookController::class);
    Route::resource('loans', LoanController::class);
});

Toutes les routes du groupe héritent automatiquement du middleware auth.

Cette approche rend le code plus lisible et évite les répétitions.


--- La gestion des accès
Dans notre projet de bibliothèque, tous les utilisateurs ne disposent pas des mêmes droits.

Par exemple :
un visiteur peut consulter le catalogue ;
un utilisateur connecté peut emprunter des livres ;
un administrateur peut gérer les livres, les auteurs et les rôles.

Les middlewares permettent de contrôler ces différents niveaux d'accès avant même que le contrôleur ne soit exécuté.

Ils constituent donc une première couche de sécurité.

Les autorisations plus fines (par exemple savoir si un utilisateur peut modifier un livre précis) seront étudiées dans les chapitres consacrés aux Gates et aux Policies.



--- Ce qu'il faut retenir
Un middleware intercepte une requête avant qu'elle n'atteigne le contrôleur.
Il peut laisser passer la requête ou l'interrompre.
Laravel fournit plusieurs middlewares prêts à l'emploi, comme auth et guest.
Les middlewares personnalisés permettent d'ajouter ses propres règles de contrôle.
Les groupes de middlewares simplifient la protection d'un ensemble de routes.
Les middlewares constituent la première étape de la sécurisation d'une application Laravel.


--- Les bonnes pratiques
Utiliser les middlewares pour toutes les vérifications communes.
Éviter de répéter les mêmes contrôles dans plusieurs contrôleurs.
Donner un nom clair aux middlewares personnalisés (AdminMiddleware, VerifiedUserMiddleware, etc.).
Utiliser les groupes de middlewares lorsque plusieurs routes partagent les mêmes règles.
Conserver les middlewares simples et spécialisés dans une seule responsabilité.


--- Les erreurs fréquentes
Confondre middlewares et contrôleurs.
Oublier d'appeler return $next($request) lorsqu'on souhaite laisser passer la requête.
Placer les vérifications d'authentification directement dans les contrôleurs au lieu d'utiliser le middleware auth.
Utiliser un middleware pour gérer des autorisations très spécifiques alors qu'une Gate ou une Policy serait plus adaptée.
Croire qu'un middleware sert uniquement à l'authentification : il peut être utilisé pour de nombreux autres traitements.


*/