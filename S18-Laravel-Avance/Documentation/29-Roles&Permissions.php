<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 29 — Les rôles et permissions
----------------------------------------------------------------------------

--- Pourquoi gérer les rôles et les permissions ?
Dans une application web, tous les utilisateurs ne possèdent pas les mêmes droits.

Prenons l'exemple de notre bibliothèque.

Un administrateur peut :
créer des livres ;
modifier des auteurs ;
supprimer des emprunts ;
gérer les utilisateurs.

En revanche, un simple abonné pourra uniquement :
consulter les livres ;
emprunter un ouvrage ;
consulter son propre historique.

Il est donc nécessaire de mettre en place un système permettant d'attribuer des droits différents selon les utilisateurs.

C'est le rôle de la gestion des rôles et des permissions.



--- Les limites du système natif
Laravel fournit déjà plusieurs outils de sécurité.

Nous avons découvert :
les middlewares, qui protègent l'accès aux routes ;
les Gates, qui vérifient des autorisations générales ;
les Policies, qui contrôlent les actions sur un modèle précis.

Ces outils sont très puissants, mais Laravel ne propose pas, par défaut, un système complet de gestion des rôles et des permissions.

Par exemple, Laravel ne fournit pas automatiquement :
une interface de gestion des rôles ;
une table des permissions ;
l'attribution de plusieurs rôles à un utilisateur ;
des méthodes permettant de manipuler facilement ces autorisations.

Pour répondre à ces besoins, il est courant d'utiliser un package spécialisé.



--- Le package Spatie Laravel Permission
Le package Spatie Laravel Permission est la solution la plus utilisée dans l'écosystème Laravel pour gérer les rôles et les permissions.

Il ajoute automatiquement :
des tables dédiées aux rôles et aux permissions ;
les relations nécessaires entre les utilisateurs et leurs droits ;
de nombreuses méthodes facilitant la gestion des autorisations.

Grâce à ce package, il n'est plus nécessaire de développer tout ce système soi-même.


--- Les rôles
Un rôle représente une catégorie d'utilisateurs partageant les mêmes responsabilités.

Par exemple :
Administrateur ;
Bibliothécaire ;
Abonné.

Attribuer un rôle à un utilisateur permet de lui associer rapidement un ensemble de permissions.

Dans Spatie, un utilisateur peut posséder un ou plusieurs rôles.

--- Les permissions
Une permission représente une action précise qu'un utilisateur est autorisé à effectuer.

Par exemple :
créer un livre ;
modifier un livre ;
supprimer un livre ;
emprunter un livre.

Contrairement aux rôles, les permissions sont très spécifiques.

Plusieurs rôles peuvent partager les mêmes permissions.

Cette séparation rend le système beaucoup plus souple et plus facile à maintenir.


--- assignRole()
La méthode assignRole() permet d'attribuer un rôle à un utilisateur.

Le package se charge automatiquement de créer les relations nécessaires dans la base de données.

Aucune manipulation SQL n'est nécessaire.

Cette méthode est généralement utilisée lors de la création d'un compte ou lorsqu'un administrateur modifie les droits d'un utilisateur.

--- hasRole()
La méthode hasRole() permet de vérifier si un utilisateur possède un rôle donné.

Elle retourne une valeur booléenne :
true si le rôle est présent ;
false dans le cas contraire.

Elle est principalement utilisée lorsque l'on souhaite adapter le comportement de l'application selon le rôle de l'utilisateur.


--- can()
La méthode can() permet de vérifier si un utilisateur possède une permission.

Contrairement à hasRole(), elle ne vérifie pas directement le rôle.

Elle vérifie si l'utilisateur dispose réellement de la permission demandée, que celle-ci provienne de son rôle ou lui ait été attribuée directement.

Cette approche est beaucoup plus flexible.

Dans une application professionnelle, il est souvent préférable de raisonner en termes de permissions plutôt qu'en termes de rôles.


--- Ce qu'il faut retenir
Un rôle représente une catégorie d'utilisateurs.
Une permission représente une action autorisée.
Laravel ne fournit pas de système complet de gestion des rôles et permissions.
Le package Spatie Laravel Permission est la solution de référence pour répondre à ce besoin.
assignRole() attribue un rôle à un utilisateur.
hasRole() vérifie la présence d'un rôle.
can() vérifie une permission.
Les rôles regroupent généralement plusieurs permissions.


--- Les bonnes pratiques
Utiliser des rôles pour représenter les grandes catégories d'utilisateurs.
Définir les autorisations en termes de permissions plutôt qu'en multipliant les rôles.
Donner des noms explicites aux permissions (create books, delete books, etc.).
Réutiliser les mêmes permissions entre plusieurs rôles lorsque cela est pertinent.
Continuer à utiliser les Gates et les Policies pour centraliser la logique d'autorisation.


--- Les erreurs fréquentes
Confondre rôle et permission.
Vérifier uniquement le rôle alors qu'une permission serait plus adaptée.
Créer un rôle différent pour chaque combinaison possible de droits.
Penser que Spatie remplace les Gates ou les Policies.
Attribuer directement de nombreuses permissions à chaque utilisateur au lieu de passer par des rôles lorsque cela est possible.
*/