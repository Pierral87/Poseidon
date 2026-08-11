<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 26 - Relations Avancées
----------------------------------------------------------------------------

--- Pourquoi les relations Many-to-Many existent ?
Nous avons déjà découvert les relations One-to-One et One-to-Many.

Ces relations fonctionnent très bien lorsqu'un enregistrement est lié à un seul autre enregistrement.

Par exemple :
un utilisateur possède un seul rôle ;
un auteur possède plusieurs livres.

Cependant, certaines situations sont plus complexes.

Prenons l'exemple de notre bibliothèque.

Un utilisateur peut emprunter plusieurs livres.

Inversement, un même livre pourra être emprunté par plusieurs utilisateurs au cours de sa vie.

Aucun des deux modèles ne peut donc contenir une simple clé étrangère vers l'autre.

On parle alors d'une relation Many-to-Many (plusieurs à plusieurs).


--- Les tables Pivot
Pour représenter une relation Many-to-Many, une troisième table est nécessaire.

Cette table est appelée table pivot.

Dans notre projet, cette table est loans.

Elle relie les utilisateurs et les livres.

users
-------
id

          loans
          ----------
          id
          user_id
          book_id
          borrowed_at
          returned_at

books
-------
id

Chaque ligne de cette table représente un emprunt.

Contrairement à une simple table de liaison, notre table contient également des informations propres à l'emprunt :
la date d'emprunt ;
la date de retour.

Elle devient donc une véritable entité métier.


--- Le modèle Pivot : Loan
Comme la table loans possède ses propres informations, nous avons créé un modèle Eloquent nommé Loan.

Ce modèle permet de manipuler directement les emprunts.

Il possède notamment les relations suivantes :
un emprunt appartient à un utilisateur (belongsTo) ;
un emprunt appartient à un livre (belongsTo).

Inversement :
un utilisateur possède plusieurs emprunts (hasMany) ;
un livre possède plusieurs emprunts (hasMany).

Cette approche est souvent plus claire lorsqu'une table pivot contient des données supplémentaires.


--- belongsToMany()
Laravel propose également une relation spécifique pour les relations Many-to-Many : belongsToMany().

Cette méthode permet de relier directement deux modèles sans manipuler explicitement la table pivot.

Par exemple :
un utilisateur possède plusieurs livres ;
un livre appartient à plusieurs utilisateurs.

Laravel se charge automatiquement d'utiliser la table pivot pour effectuer les jointures nécessaires.

Lorsque la table pivot contient des colonnes supplémentaires, il est possible de les récupérer grâce à la méthode withPivot().


--- attach()
La méthode attach() permet d'ajouter une nouvelle relation Many-to-Many.
Dans notre projet, elle permettrait par exemple de créer un nouvel emprunt entre un utilisateur et un livre.
Si des informations supplémentaires existent dans la table pivot, elles peuvent être fournies lors de l'appel.
Cette méthode est particulièrement pratique lorsqu'il s'agit simplement d'ajouter une nouvelle relation.


--- detach()
La méthode detach() supprime une relation Many-to-Many.

Dans notre bibliothèque, cela reviendrait à supprimer un emprunt entre un utilisateur et un livre.

Seule la relation est supprimée.

Les utilisateurs et les livres restent présents dans la base de données.


--- sync()
La méthode sync() permet de synchroniser plusieurs relations en une seule opération.

Laravel compare la liste fournie avec les relations existantes :

les nouvelles relations sont créées ;
celles qui n'existent plus sont supprimées.

Cette méthode est très utilisée lorsqu'un formulaire permet de sélectionner plusieurs éléments.

Il faut cependant l'utiliser avec prudence, car elle peut supprimer automatiquement des relations existantes.


--- Les relations polymorphiques
Les relations polymorphiques permettent à un même modèle de travailler avec plusieurs types d'objets.

Imaginons que notre bibliothèque décide également de prêter des CD.

Sans relation polymorphique, il faudrait créer plusieurs tables d'emprunts.

Par exemple :
book_loans
cd_loans

Laravel propose une solution plus élégante.

La table loans peut contenir deux informations supplémentaires :
le type de l'objet emprunté ;
son identifiant.

Ainsi, un même emprunt peut concerner aussi bien un livre qu'un CD.

Cette technique est appelée relation polymorphique.

Elle est particulièrement utile dans les projets de grande taille.


--- Ce qu'il faut retenir
Une relation Many-to-Many relie plusieurs enregistrements des deux côtés.
Une table pivot est nécessaire pour représenter cette relation.
Lorsque la table pivot contient ses propres informations, il est conseillé de créer un modèle dédié.
belongsToMany() permet de manipuler directement les relations Many-to-Many.
attach() ajoute une relation.
detach() supprime une relation.
sync() synchronise plusieurs relations en une seule opération.
Les relations polymorphiques permettent d'associer un même modèle à plusieurs types d'objets.


--- Les bonnes pratiques
Créer un modèle dédié lorsqu'une table pivot possède des données métier.
Donner un nom explicite au modèle pivot (Loan, Enrollment, OrderItem, etc.).
Utiliser attach(), detach() et sync() uniquement lorsque leur comportement est bien compris.
Réserver les relations polymorphiques aux situations où plusieurs modèles partagent réellement le même comportement.
Préférer une modélisation simple avant d'introduire des relations avancées.


--- Les erreurs fréquentes
Vouloir créer une clé étrangère directement dans chacun des deux modèles d'une relation Many-to-Many.
Oublier qu'une table pivot peut contenir ses propres informations.
Utiliser sync() sans réaliser qu'il peut supprimer des relations existantes.
Confondre une table pivot classique avec un véritable modèle métier.
Introduire une relation polymorphique alors qu'une relation classique serait suffisante.
*/