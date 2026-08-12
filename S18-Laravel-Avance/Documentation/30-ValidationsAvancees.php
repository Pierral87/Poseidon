<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 30 — Validation avancée
----------------------------------------------------------------------------

--- Pourquoi utiliser un FormRequest ?
Nous avons découvert la méthode $request->validate(), qui permet de vérifier rapidement les données d'un formulaire.

Cette méthode est parfaitement adaptée aux formulaires simples.

Cependant, dans une application plus importante, les mêmes règles de validation sont souvent utilisées à plusieurs endroits.

Par exemple, les méthodes store() et update() d'un même contrôleur peuvent partager exactement les mêmes validations.

Recopier ces règles dans plusieurs méthodes rend le code plus difficile à maintenir.

Pour résoudre ce problème, Laravel propose les FormRequest.

Un FormRequest est une classe dédiée qui regroupe toutes les règles de validation d'un formulaire.

Le contrôleur devient ainsi plus simple, plus lisible et plus facile à maintenir.


--- La méthode authorize()
Chaque FormRequest possède une méthode authorize().

Son rôle est de déterminer si la requête est autorisée.

Elle retourne un booléen :
true : la requête est acceptée ;
false : Laravel renvoie automatiquement une erreur 403 - Forbidden.

Dans notre projet, nous retournons généralement true, car les autorisations sont déjà gérées par les Policies.

Cependant, cette méthode permet, si nécessaire, d'ajouter directement une logique d'autorisation spécifique à la requête.


--- La méthode rules()
La méthode rules() contient toutes les règles de validation du formulaire.

Elle remplace les appels à $request->validate() présents dans les contrôleurs.

Toutes les validations sont ainsi regroupées dans une seule classe.

Cette organisation facilite la maintenance et favorise la réutilisation du code.


--- Les messages personnalisés
Laravel fournit des messages d'erreur par défaut.

Il est toutefois possible de les personnaliser afin de les rendre plus compréhensibles pour les utilisateurs.

Chaque règle peut ainsi posséder son propre message.

Cette personnalisation améliore considérablement l'expérience utilisateur.


--- Les règles personnalisées
Les règles intégrées de Laravel couvrent la majorité des besoins.

Lorsque ce n'est pas suffisant, il est possible de créer ses propres règles de validation.

Ces règles sont regroupées dans des classes dédiées et peuvent ensuite être réutilisées dans plusieurs formulaires.

Elles permettent de répondre à des besoins métier très spécifiques.


--- La réutilisation des validations
L'un des principaux avantages des FormRequest est la réutilisation.

Une même classe peut être utilisée dans plusieurs méthodes ou plusieurs contrôleurs.

Toutes les modifications sont alors effectuées à un seul endroit.

Cette approche respecte le principe DRY (Don't Repeat Yourself), qui consiste à éviter la duplication de code.


--- Ce qu'il faut retenir
Les FormRequest permettent de sortir les validations des contrôleurs.
authorize() vérifie si la requête est autorisée.
rules() regroupe toutes les règles de validation.
Les messages peuvent être personnalisés.
Les règles personnalisées permettent de répondre à des besoins spécifiques.
Les FormRequest rendent le code plus lisible, plus réutilisable et plus facile à maintenir.


--- Les bonnes pratiques
Utiliser un FormRequest dès qu'un formulaire devient un peu complexe.
Regrouper toutes les règles d'un formulaire dans une seule classe.
Personnaliser les messages d'erreur destinés aux utilisateurs.
Éviter de dupliquer les validations dans plusieurs contrôleurs.
Réserver les règles personnalisées aux besoins réellement spécifiques.


--- Les erreurs fréquentes
Oublier de retourner true dans authorize().
Continuer à utiliser $request->validate() partout malgré l'existence d'un FormRequest.
Dupliquer les mêmes règles dans plusieurs classes.
Mélanger logique métier et logique de validation.
Créer une règle personnalisée alors qu'une règle intégrée de Laravel existe déjà.
*/