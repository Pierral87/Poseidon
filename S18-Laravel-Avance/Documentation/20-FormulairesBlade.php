<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 20 - Les formulaires Blade
----------------------------------------------------------------------------

--- Pourquoi les formulaires existent ?
Une application web ne se limite pas à afficher des informations. Les utilisateurs doivent également pouvoir interagir avec elle.

Les formulaires permettent de saisir des données qui seront ensuite envoyées au serveur afin d'être enregistrées, modifiées ou utilisées par l'application.

Dans notre projet de bibliothèque, un formulaire permettra par exemple :
de créer un nouveau rôle ;
d'ajouter un auteur ;
d'enregistrer un livre ;
de créer un nouvel utilisateur.

Les formulaires constituent donc le principal moyen de communication entre l'utilisateur et notre application.


--- La structure d'un formulaire
En HTML, un formulaire est défini à l'aide de la balise <form>.
Cette balise possède deux attributs importants :
action : indique l'adresse à laquelle les données seront envoyées.
method : indique la méthode HTTP utilisée.

Exemple :
<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <input type="text" name="name">
    <button>Créer</button>
</form>

Laravel recommande d'utiliser la fonction route() afin de générer automatiquement les URL de l'application.

Cela évite d'écrire les chemins en dur et facilite la maintenance du projet.


--- Les méthodes GET et POST
Lorsqu'un formulaire est envoyé, il utilise une méthode HTTP.

Les deux méthodes les plus courantes sont :

    --- GET
La méthode GET est utilisée pour demander des informations au serveur.
Elle est principalement utilisée pour :
afficher une page ;
effectuer une recherche ;
consulter des informations.
Les données sont visibles dans l'URL.

Exemple :
/recherche?mot=laravel

    --- POST
La méthode POST est utilisée pour envoyer des données au serveur.
Elle est principalement utilisée pour :
créer une nouvelle donnée ;
envoyer un formulaire ;
transmettre des informations sensibles.
Les données ne sont pas visibles dans l'URL.

Dans Laravel, la plupart des formulaires utilisent donc la méthode POST.


--- La protection CSRF
Laravel protège automatiquement tous les formulaires contre les attaques de type CSRF (Cross-Site Request Forgery).
Une attaque CSRF consiste à envoyer un formulaire à l'insu de l'utilisateur afin d'exécuter une action non souhaitée.
Pour empêcher cela, Laravel ajoute un jeton de sécurité (appelé token CSRF) dans chaque formulaire.

Il suffit d'ajouter la directive :
@csrf

Cette directive génère automatiquement un champ caché contenant ce jeton.
Si ce jeton est absent ou invalide, Laravel refuse immédiatement la requête.
L'utilisation de @csrf est obligatoire pour tous les formulaires envoyés en POST, PUT, PATCH ou DELETE.


--- Le helper old()
Lorsqu'une validation échoue, Laravel peut automatiquement réafficher les données précédemment saisies.

Pour cela, on utilise le helper :
old('name')
Exemple :
<input
    type="text"
    name="name"
    value="{{ old('name') }}"
>

Ainsi, si l'utilisateur commet une erreur lors de la saisie, il n'a pas besoin de remplir à nouveau tout le formulaire.
Cela améliore considérablement l'expérience utilisateur.


--- L'affichage des erreurs avec @error
Lorsque Laravel détecte une erreur de validation, il peut afficher automatiquement le message correspondant.
La directive Blade @error permet d'afficher ce message.

Exemple :
@error('name')
<p>{{ $message }}</p>
@enderror

Le texte contenu dans la variable $message est généré automatiquement par Laravel.
Cette directive ne produit aucun affichage si aucune erreur n'est présente.



--- Ce qu'il faut retenir
Un formulaire permet à l'utilisateur d'envoyer des données au serveur.
La balise <form> utilise les attributs action et method.
La méthode GET est utilisée pour consulter des informations.
La méthode POST est utilisée pour envoyer des données.
Tous les formulaires Laravel doivent contenir la directive @csrf.
Le helper old() permet de conserver les valeurs précédemment saisies.
La directive @error permet d'afficher facilement les messages de validation.


--- Les bonnes pratiques
Toujours utiliser route() plutôt qu'une URL écrite en dur.
Ajouter systématiquement @csrf dans les formulaires.
Utiliser old() sur tous les champs de saisie afin d'améliorer le confort de l'utilisateur.
Afficher les erreurs de validation à proximité du champ concerné.
Donner des noms explicites aux champs (name, email, password, etc.).


--- Les erreurs fréquentes
Oublier la directive @csrf, ce qui provoque une erreur 419 Page Expired.
Confondre les méthodes GET et POST.
Écrire directement l'URL dans l'attribut action au lieu d'utiliser route().
Oublier old(), obligeant l'utilisateur à ressaisir toutes les informations après une erreur.
Penser que @error effectue la validation : cette directive ne fait qu'afficher un message si une validation a déjà échoué.

*/