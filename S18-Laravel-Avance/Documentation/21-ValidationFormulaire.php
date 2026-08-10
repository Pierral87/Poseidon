<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 21 - Validations des formulaires
----------------------------------------------------------------------------

--- Pourquoi valider les données ?
Les données saisies par un utilisateur ne doivent jamais être considérées comme fiables.

Un utilisateur peut :
oublier de remplir un champ obligatoire ;
saisir une adresse e-mail incorrecte ;
entrer un texte beaucoup trop long ;
envoyer volontairement des données invalides.

Si aucune vérification n'est effectuée, ces données seront enregistrées dans la base de données et pourront provoquer des erreurs ou rendre l'application incohérente.

La validation consiste donc à vérifier que les informations reçues respectent les règles définies par l'application avant d'être enregistrées.

Dans Laravel, cette étape est simple à mettre en œuvre grâce à la méthode validate().


--- La méthode $request->validate()
Laravel permet de valider les données d'un formulaire directement dans un contrôleur.

Exemple :
$request->validate([
    'name' => 'required'
]);

Dans cet exemple, le champ name devient obligatoire.

Lorsque la validation est exécutée, deux situations sont possibles :
Toutes les règles sont respectées : le traitement continue normalement.
Une ou plusieurs règles échouent : Laravel interrompt immédiatement l'exécution de la méthode, redirige l'utilisateur vers le formulaire et affiche les erreurs correspondantes.

Cette gestion est entièrement automatique.


--- Les règles de validation
Laravel propose un très grand nombre de règles de validation.

Voici quelques-unes des plus utilisées.

Règle	            Description
required	        Le champ est obligatoire
nullable	        Le champ peut être vide
string	            Le champ doit être une chaîne de caractères
integer	            Le champ doit être un entier
numeric	            Le champ doit être un nombre
email	            Le champ doit contenir une adresse e-mail valide
date	            Le champ doit être une date valide
min	                Valeur ou longueur minimale
max	                Valeur ou longueur maximale
unique	            La valeur ne doit pas déjà exister dans la base

Plusieurs règles peuvent être combinées sur un même champ.

Exemple :
$request->validate([
    'name' => 'required|string|min:3|max:50'
]);

Chaque règle est appliquée dans l'ordre.


--- Les messages d'erreur
Laravel génère automatiquement des messages d'erreur lorsqu'une validation échoue.

Par exemple, si un champ obligatoire est laissé vide, un message approprié est affiché à l'utilisateur.
Il est également possible de personnaliser ces messages.

Exemple :
$request->validate(
    [
        'name' => 'required|min:3'
    ],
    [
        'name.required' => 'Le nom du rôle est obligatoire.',
        'name.min' => 'Le nom doit contenir au moins 3 caractères.'
    ]
);

Personnaliser les messages permet d'obtenir une application plus agréable à utiliser et plus facile à comprendre.


--- Les données validées
La méthode validate() retourne un tableau contenant uniquement les données ayant passé la validation.

Il est recommandé d'utiliser directement ce tableau.
Exemple :
$validated = $request->validate([
    'name' => 'required|string'
]);

Role::create($validated);

Cette approche évite de manipuler des données qui n'ont pas été vérifiées.


--- La validation des données utilisateur
La validation ne concerne pas uniquement les formulaires de création.
Elle doit être utilisée chaque fois que l'utilisateur envoie des données à l'application.

Par exemple :
création d'un utilisateur ;
modification d'un livre ;
ajout d'un auteur ;
formulaire de connexion ;
changement de mot de passe.

Chaque formulaire doit posséder ses propres règles de validation.
Les règles utilisées dépendent des besoins de l'application.


--- La validation et Blade
Dans le chapitre précédent, nous avons utilisé les éléments suivants :
old()
et
@error

Ces deux fonctionnalités prennent tout leur sens avec la validation.

Lorsque celle-ci échoue :
Laravel conserve automatiquement les anciennes valeurs grâce à old().
Les messages d'erreur sont accessibles avec @error.
Aucun code supplémentaire n'est nécessaire.
Laravel gère automatiquement cette partie.


--- Ce qu'il faut retenir
Toutes les données envoyées par un utilisateur doivent être validées.
La méthode $request->validate() permet de vérifier facilement les informations reçues.
Laravel possède de nombreuses règles de validation prêtes à l'emploi.
Les messages d'erreur peuvent être personnalisés.
Les données validées peuvent être récupérées directement grâce au tableau retourné par validate().
Les helpers old() et @error fonctionnent automatiquement avec la validation.


--- Les bonnes pratiques
Toujours valider les données avant de les enregistrer dans la base de données.
Utiliser les règles les plus adaptées au type de données attendu.
Personnaliser les messages d'erreur lorsque cela améliore la compréhension de l'utilisateur.
Utiliser les données retournées par validate() plutôt que les données brutes de la requête.
Éviter de dupliquer les mêmes règles de validation dans plusieurs méthodes (nous verrons une solution plus élégante avec les Form Requests).


--- Les erreurs fréquentes
Penser que les champs HTML required remplacent la validation Laravel. Ils améliorent l'expérience utilisateur, mais ne sécurisent pas l'application.
Oublier de valider un champ avant son enregistrement.
Utiliser des règles inadaptées (numeric pour un nom, par exemple).
Écrire des validations trop permissives ou au contraire trop restrictives.
Croire que old() ou @error effectuent eux-mêmes la validation : ils ne font qu'exploiter le résultat de celle-ci.

*/
