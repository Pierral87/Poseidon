<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 33 — Les fonctionnalités Eloquent avancées
----------------------------------------------------------------------------

--- Pourquoi ces fonctionnalités existent ?
Au fil du développement d'une application, certaines situations reviennent très souvent.

Par exemple :
afficher une liste de résultats sur plusieurs pages ;
conserver les données supprimées sans les effacer définitivement ;
restaurer un élément supprimé par erreur.

Laravel intègre directement plusieurs fonctionnalités permettant de répondre à ces besoins sans avoir à les développer soi-même.

Parmi les plus utilisées figurent :
les Soft Deletes, qui permettent de supprimer des données de manière logique ;
la Pagination, qui facilite l'affichage de longues listes de résultats.

Ces fonctionnalités sont directement intégrées à Eloquent et demandent très peu de code.


--- Les Soft Deletes
Par défaut, lorsqu'un modèle est supprimé avec la méthode delete(), la ligne est définitivement retirée de la base de données.

Dans certaines applications, cette suppression définitive n'est pas souhaitable.

Il peut être nécessaire de conserver les données afin de pouvoir :
restaurer un élément supprimé par erreur ;
conserver un historique ;
répondre à des obligations légales ou fonctionnelles.

Les Soft Deletes permettent de résoudre ce problème.

Au lieu de supprimer la ligne, Laravel renseigne simplement la colonne deleted_at avec la date et l'heure de la suppression.

L'enregistrement reste présent dans la base de données, mais il est automatiquement ignoré par les requêtes Eloquent classiques.


--- withTrashed()
Par défaut, les modèles supprimés logiquement ne sont plus retournés par Eloquent.

La méthode withTrashed() permet de récupérer également ces enregistrements.

Elle est particulièrement utile dans une interface d'administration ou pour afficher une corbeille.


--- onlyTrashed()
La méthode onlyTrashed() permet de récupérer uniquement les modèles ayant été supprimés logiquement.

Elle est souvent utilisée pour créer une page dédiée aux éléments supprimés.

Cette méthode facilite la gestion d'une corbeille dans une application.


--- restore()
La méthode restore() permet de restaurer un modèle ayant été supprimé avec les Soft Deletes.

Laravel remet simplement la colonne deleted_at à NULL.

Le modèle redevient alors visible dans toutes les requêtes classiques.

Cette fonctionnalité évite de devoir recréer manuellement des données supprimées par erreur.


--- La pagination
Lorsqu'une table contient quelques dizaines de lignes, il est possible d'afficher tous les résultats sur une seule page.

En revanche, dans une application réelle, certaines tables peuvent contenir plusieurs milliers d'enregistrements.

Afficher tous ces résultats simultanément ralentit l'application et rend la navigation difficile pour l'utilisateur.

La pagination consiste à diviser les résultats en plusieurs pages.

Laravel fournit un système de pagination intégré, très simple à mettre en place.

Il suffit d'utiliser la méthode paginate() à la place de get() ou all().

Laravel se charge ensuite de récupérer uniquement les données nécessaires à la page demandée et de générer automatiquement les liens de navigation.


--- paginate()
La méthode paginate() permet de limiter automatiquement le nombre de résultats affichés.

Le développeur indique simplement le nombre d'éléments à afficher par page.

Laravel :
récupère uniquement les données nécessaires ;
calcule le nombre total de pages ;
génère les liens de navigation.

Cette méthode améliore à la fois les performances de l'application et le confort de navigation des utilisateurs.



--- Ce qu'il faut retenir
Les Soft Deletes permettent de supprimer un enregistrement sans l'effacer définitivement.
La colonne deleted_at indique qu'un modèle a été supprimé logiquement.
withTrashed() récupère également les modèles supprimés.
onlyTrashed() récupère uniquement les modèles supprimés.
restore() restaure un modèle supprimé.
paginate() permet de découper automatiquement les résultats en plusieurs pages.
Ces fonctionnalités sont directement intégrées à Eloquent et nécessitent très peu de code.


--- Les bonnes pratiques
Utiliser les Soft Deletes lorsque les données peuvent avoir besoin d'être restaurées.
Réserver les suppressions définitives (forceDelete()) aux cas réellement nécessaires.
Mettre en place une corbeille pour les données importantes.
Utiliser la pagination dès qu'une liste peut contenir un grand nombre d'enregistrements.
Choisir un nombre raisonnable d'éléments par page afin d'assurer une bonne expérience utilisateur.


--- Les erreurs fréquentes
Penser qu'un Soft Delete supprime réellement la ligne de la base de données.
Oublier d'ajouter le trait SoftDeletes dans le modèle.
Confondre withTrashed() et onlyTrashed().
Utiliser forceDelete() sans être certain de vouloir supprimer définitivement les données.
Continuer à utiliser all() sur de très grandes tables au lieu de mettre en place une pagination.


*/
