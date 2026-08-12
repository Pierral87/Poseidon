<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 28 - Policies
----------------------------------------------------------------------------

--- Pourquoi les Policies existent ?
Nous avons découvert précédemment les Gates, qui permettent de vérifier si un utilisateur est autorisé à effectuer une action.

Par exemple :
gérer les livres ;
gérer les auteurs ;
accéder au panneau d'administration.

Ces autorisations sont dites globales, car elles ne concernent pas un enregistrement particulier.

Cependant, dans une application réelle, les droits dépendent souvent de l'objet manipulé.

Prenons un exemple.

Deux bibliothécaires sont connectés à notre application.

Ils possèdent tous les deux le droit de modifier des livres.

Mais devons-nous leur permettre de modifier tous les livres de la bibliothèque ?

Peut-être souhaitons-nous qu'ils puissent uniquement modifier les livres qu'ils ont eux-mêmes créés.

Dans ce cas, il ne suffit plus de connaître l'utilisateur.

Il faut également connaître le livre concerné.

C'est exactement le rôle des Policies.

Une Policy permet de vérifier si un utilisateur est autorisé à effectuer une action sur une instance précise d'un modèle.


--- Le principe des Policies
Une Policy est une classe associée à un modèle Eloquent.

Elle contient toutes les règles d'autorisation concernant ce modèle.

Par exemple, une BookPolicy peut répondre aux questions suivantes :

un utilisateur peut-il consulter ce livre ?
peut-il le modifier ?
peut-il le supprimer ?
peut-il en créer un nouveau ?

Chaque méthode de la Policy correspond à une action métier.

Laravel appelle automatiquement la méthode appropriée lorsqu'une autorisation est demandée.


--- Génération d'une Policy
Laravel permet de créer une Policy grâce à Artisan.
php artisan make:policy BookPolicy --model=Book

Une fois générée, elle contient déjà plusieurs méthodes représentant les actions les plus courantes :

consulter une liste (viewAny) ;
consulter un élément (view) ;
créer (create) ;
modifier (update) ;
supprimer (delete) ;
restaurer (restore) ;
supprimer définitivement (forceDelete).

Il est bien entendu possible d'ajouter d'autres méthodes si les besoins de l'application l'exigent.


--- La méthode authorize()
Pour utiliser une Policy, Laravel fournit la méthode authorize().

Cette méthode est généralement appelée directement dans un contrôleur.

Elle reçoit :
le nom de l'action ;
le modèle concerné.

Laravel recherche alors automatiquement la Policy associée au modèle et exécute la méthode correspondante.

Si l'autorisation est accordée, le traitement continue normalement.

Dans le cas contraire, Laravel interrompt immédiatement l'exécution et retourne une erreur 403 - Forbidden.

Cette approche permet de centraliser toute la logique d'autorisation sans alourdir les contrôleurs.



--- La liaison avec les modèles
Une Policy est toujours liée à un modèle Eloquent.

Par exemple :
BookPolicy est associée au modèle Book ;
UserPolicy est associée au modèle User ;
LoanPolicy pourrait être associée au modèle Loan.

Cette liaison permet à Laravel de transmettre automatiquement l'objet concerné à la Policy.

Ainsi, la règle d'autorisation peut utiliser les informations contenues dans cet objet.

Par exemple :
savoir qui a créé un livre ;
vérifier si un emprunt appartient à l'utilisateur connecté ;
contrôler le propriétaire d'une ressource.

Les Policies permettent donc de prendre des décisions beaucoup plus fines que les Gates.


--- Les différences avec les Gates
Les Gates et les Policies poursuivent le même objectif : contrôler les autorisations.

La différence réside dans leur niveau de précision.

Une Gate répond à une autorisation générale.

Par exemple :
gérer les livres ;
gérer les auteurs ;
accéder à l'administration.

Une Policy, elle, répond à une autorisation portant sur un objet précis.

Par exemple :
modifier ce livre ;
supprimer cet emprunt ;
consulter ce profil utilisateur.

Les Policies sont donc particulièrement adaptées aux opérations de type CRUD.


--- Ce qu'il faut retenir
Une Policy regroupe toutes les autorisations concernant un modèle Eloquent.
Elle reçoit automatiquement l'utilisateur connecté ainsi que le modèle concerné.
La méthode authorize() permet de vérifier une autorisation directement depuis un contrôleur.
Les Policies centralisent la logique d'autorisation et évitent de répéter les mêmes conditions dans plusieurs contrôleurs.
Les Gates gèrent des autorisations globales, tandis que les Policies gèrent des autorisations liées à une instance précise d'un modèle.


--- Les bonnes pratiques
Créer une Policy pour chaque modèle important de l'application.
Regrouper toutes les autorisations d'un modèle dans sa Policy.
Utiliser authorize() dans les contrôleurs plutôt que d'écrire directement les conditions.
Donner à chaque méthode de la Policy une responsabilité unique.
Laisser les contrôleurs se concentrer sur le traitement métier plutôt que sur la gestion des droits.


--- Les erreurs fréquentes
Confondre Gate et Policy.
Continuer à écrire les règles d'autorisation directement dans les contrôleurs.
Créer une Gate pour chaque modèle alors qu'une Policy serait plus adaptée.
Oublier qu'une Policy travaille toujours avec une instance précise d'un modèle.
Penser que les Policies remplacent les middlewares : les deux mécanismes sont complémentaires.

*/