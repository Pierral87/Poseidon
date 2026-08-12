<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 27 - Les Gates
----------------------------------------------------------------------------

--- Pourquoi les Gates existent ?
Nous avons découvert précédemment les middlewares, qui permettent de protéger des routes.

Par exemple, le middleware auth vérifie qu'un utilisateur est connecté avant de lui permettre d'accéder à une page.

Cependant, être connecté ne signifie pas que l'on peut tout faire.

Imaginons notre application de bibliothèque.

Deux utilisateurs sont connectés :
un administrateur ;
un simple utilisateur.

Tous les deux peuvent accéder à la liste des livres.

En revanche :
seul l'administrateur doit pouvoir créer un nouveau livre ;
seul l'administrateur doit pouvoir supprimer un auteur ;
un utilisateur classique ne doit pouvoir effectuer que certaines actions.

Les Gates permettent justement de répondre à cette question.

Elles vérifient si un utilisateur est autorisé à réaliser une action précise.


--- Middleware ou Gate ?
Il est important de distinguer ces deux mécanismes.

Le middleware répond à la question :
L'utilisateur peut-il accéder à cette route ?

La Gate répond à une autre question :
L'utilisateur peut-il effectuer cette action ?

Par exemple :
le middleware auth autorise l'accès à la page des livres ;
une Gate décide si le bouton « Supprimer » doit réellement fonctionner.

Les deux mécanismes sont complémentaires.



--- Le principe des Gates
Une Gate est une règle d'autorisation définie dans l'application.

Elle reçoit automatiquement l'utilisateur actuellement connecté.

Son rôle est de répondre par :
true : l'action est autorisée ;
false : l'action est refusée.

Chaque Gate représente une autorisation métier.

Par exemple :
gérer les livres ;
gérer les auteurs ;
gérer les rôles ;
emprunter un livre.

Il est recommandé de donner aux Gates des noms représentant une action plutôt qu'un rôle.

Par exemple :
manage-books
delete-book
manage-authors

Ces noms décrivent clairement l'autorisation vérifiée.


--- La création d'une Gate
Les Gates sont généralement déclarées dans la méthode boot() du fournisseur de services de l'application. 
app/Providers/AppServiceProvider.php 

Une Gate possède :
un nom ;
une fonction recevant l'utilisateur connecté ;
une valeur de retour (true ou false).

Elle centralise ainsi la logique d'autorisation à un seul endroit du projet.


--- Gate::allows()
Laravel fournit la méthode Gate::allows() pour vérifier une autorisation.

Cette méthode retourne un booléen :
true si l'action est autorisée ;
false sinon.

Elle est principalement utilisée dans les contrôleurs afin de protéger les traitements sensibles.

Si la Gate refuse l'action, le contrôleur peut interrompre immédiatement l'exécution ou retourner une erreur d'autorisation.


--- La directive Blade @can
Les Gates peuvent également être utilisées directement dans les vues Blade grâce à la directive @can.

Cette directive permet d'afficher ou de masquer une partie de l'interface selon les droits de l'utilisateur.

Par exemple, le bouton « Supprimer » peut être affiché uniquement aux administrateurs.

Il est important de comprendre que cette directive améliore uniquement l'interface utilisateur.

Elle ne remplace pas la vérification réalisée dans le contrôleur.

Un utilisateur malveillant pourrait toujours tenter d'appeler directement l'URL concernée.

La véritable sécurité doit donc toujours être réalisée côté serveur.


--- Ce qu'il faut retenir
Les Gates permettent de gérer les autorisations d'une application.
Elles complètent les middlewares mais ne les remplacent pas.
Une Gate répond toujours à une question métier : « cet utilisateur peut-il effectuer cette action ? »
Gate::allows() permet de vérifier une autorisation dans le code PHP.
La directive @can permet d'adapter l'affichage des vues Blade selon les droits de l'utilisateur.
Les vérifications importantes doivent toujours être effectuées dans les contrôleurs, même si l'interface masque certains boutons.


--- Les bonnes pratiques
Donner aux Gates des noms représentant une action (manage-books, delete-book, etc.).
Regrouper la logique d'autorisation dans les Gates plutôt que de la dupliquer dans plusieurs contrôleurs.
Utiliser @can pour simplifier l'affichage conditionnel dans les vues.
Toujours vérifier les autorisations côté serveur, même si l'action est masquée dans l'interface.
Créer une Gate pour chaque autorisation importante de l'application.


--- Les erreurs fréquentes
Confondre Gate et middleware.
Penser que @can protège réellement une action : il ne fait que masquer une partie de l'interface.
Vérifier uniquement les autorisations dans Blade sans les contrôler dans le contrôleur.
Donner aux Gates des noms représentant des rôles (is-admin) plutôt que des actions (manage-books).
Dupliquer les mêmes vérifications dans plusieurs contrôleurs au lieu de les centraliser dans une Gate.


*/