<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 22 - Les attributs Eloquent
----------------------------------------------------------------------------

--- Pourquoi les attributs Eloquent existent ?
Les données enregistrées dans une base ne sont pas toujours stockées sous la forme dans laquelle on souhaite les afficher.

À l'inverse, les données saisies par un utilisateur doivent parfois être transformées avant d'être enregistrées.

Plutôt que d'effectuer ces traitements dans tous les contrôleurs, Laravel permet de les centraliser directement dans les modèles grâce aux attributs Eloquent.

Cette approche rend le code plus propre, plus lisible et plus facile à maintenir.


--- Les Accessors (les getters)
Un Accessor permet de modifier la valeur d'un attribut au moment de sa lecture.
La donnée enregistrée dans la base n'est jamais modifiée.
Par exemple, on peut afficher automatiquement le nom d'un rôle en majuscules sans modifier la valeur réellement stockée.

Les Accessors sont utiles pour :
mettre un texte en majuscules ou en minuscules ;
formater une date ;
construire un nom complet à partir d'un prénom et d'un nom ;
préparer une valeur pour l'affichage.


--- Les Mutators (les setters)
Un Mutator agit au moment de l'enregistrement.
Il permet de transformer automatiquement une valeur avant qu'elle ne soit enregistrée dans la base.
Par exemple, on peut forcer la première lettre d'un rôle à être en majuscule, quelle que soit la saisie de l'utilisateur.
Les Mutators permettent ainsi de garantir une présentation homogène des données.


--- Les Casts
Les Casts permettent à Laravel de convertir automatiquement certains attributs vers un type PHP adapté.
Par exemple, un champ de type date peut être automatiquement transformé en objet Carbon.
Laravel fournit déjà plusieurs Casts très utiles :
datetime
boolean
integer
array
json
hashed
Grâce aux Casts, il n'est plus nécessaire de réaliser ces conversions manuellement.


--- Les méthodes isDirty(), isClean() et wasChanged()
Laravel permet de savoir si un modèle a été modifié.

    -- isDirty()
Retourne true lorsqu'un ou plusieurs attributs ont été modifiés mais n'ont pas encore été enregistrés.

    -- isClean()
Retourne true lorsqu'aucune modification n'est en attente.

    -- wasChanged()
Retourne true si un attribut a effectivement été modifié lors du dernier appel à save().

Ces méthodes sont principalement utilisées dans des traitements métiers avancés ou lors du débogage.


--- Ce qu'il faut retenir
Les Accessors modifient une valeur lors de sa lecture.
Les Mutators modifient une valeur avant son enregistrement.
Les Casts convertissent automatiquement les types de données.
isDirty(), isClean() et wasChanged() permettent de suivre les modifications d'un modèle.
Les traitements liés aux données doivent être placés dans les modèles plutôt que dans les contrôleurs.


--- Les bonnes pratiques
Centraliser les transformations dans les modèles.
Utiliser les Casts dès qu'une conversion de type est nécessaire.
Éviter de reproduire les mêmes traitements dans plusieurs contrôleurs.
Réserver isDirty() et wasChanged() aux cas où ils apportent une réelle valeur.


--- Les erreurs fréquentes
Confondre Accessor et Mutator.
Modifier les données directement dans les vues.
Réaliser des conversions de dates dans les contrôleurs alors que les Casts existent.
Penser que l'Accessor modifie la base de données : il agit uniquement lors de la lecture.

*/