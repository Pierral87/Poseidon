<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 24 - Les Sessions
----------------------------------------------------------------------------

--- Pourquoi HTTP est-il stateless ?
Le protocole HTTP fonctionne selon un principe simple : chaque requête est indépendante des précédentes.
Lorsqu'un navigateur envoie une requête à un serveur, celui-ci traite la demande, renvoie une réponse puis oublie immédiatement cette interaction.
Il ne conserve aucune mémoire des requêtes précédentes.
On dit alors que le protocole HTTP est stateless, c'est-à-dire « sans état ».
Ce fonctionnement présente de nombreux avantages en termes de simplicité et de performances, mais il pose également un problème.
Comment une application peut-elle savoir qu'un utilisateur est connecté s'il n'existe aucune mémoire entre deux requêtes ?
Pour répondre à cette question, les applications web utilisent les cookies et les sessions.


--- Les cookies
Un cookie est une petite information enregistrée par le navigateur.
Dans Laravel, le cookie ne contient généralement pas les informations de l'utilisateur.
Il contient uniquement un identifiant permettant de retrouver la session correspondante sur le serveur.
Le cookie joue donc le rôle d'une clé permettant d'accéder aux informations enregistrées côté serveur.


--- Les sessions
Une session est un espace de stockage temporaire associé à un utilisateur.
Contrairement aux cookies, les données de la session sont stockées côté serveur.
Laravel peut y enregistrer de nombreuses informations, par exemple :
l'identifiant de l'utilisateur connecté ;
des préférences de navigation ;
des données temporaires ;
des messages destinés à être affichés à l'utilisateur.
Grâce à cette session, Laravel est capable de reconnaître automatiquement un utilisateur lors de chacune de ses requêtes.

On peut manipuler les sessions via le helper session() 
ecriture
session(['theme' => 'dark', 'step' => 2]);
lecture
$theme = session('theme', 'light'); // 'light' est la valeur par défaut si la clé n'existe pas
supprimer
session()->forget('theme');

Ou via l'objet $request->session()
ecriture 
$request->session()->put('theme', 'dark');
// Ou pour ajouter plusieurs valeurs d'un coup :
$request->session()->put(['theme' => 'dark', 'step' => 2]);
lecture 
$theme = $request->session()->get('theme', 'light');
verification
if ($request->session()->has('theme')) {
    // ...
}
suppression
$request->session()->forget('theme');

--- Les Flash Sessions
Certaines informations ne doivent être conservées que pendant une seule requête.
C'est le cas des messages affichés après une action.

Par exemple :
« Le rôle a été créé avec succès. »
« Le livre a été supprimé. »
« Votre profil a été mis à jour. »
Laravel propose les Flash Sessions pour répondre à ce besoin.
Une Flash Session est automatiquement supprimée après avoir été affichée une première fois.


--- Les messages Flash
Lors d'une redirection, Laravel permet de créer très facilement un message Flash grâce à la méthode with().

Exemple :
return redirect()
    ->route('roles.create')
    ->with('success', 'Le rôle a été créé avec succès.');

ou

$request->session()->flash('status', 'Profil mis à jour !');
ou
session()->flash(
        'success',
        'Le rôle a été créé.'
    );
    
Le message est enregistré dans la session, puis automatiquement supprimé après avoir été affiché.


--- Utilisation dans Blade
Dans une vue Blade, un message Flash peut être affiché grâce au helper session().

Exemple :
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

Si aucun message n'est présent dans la session, rien n'est affiché.

Cette approche est très utilisée pour informer l'utilisateur qu'une opération s'est correctement déroulée.


--- Ce qu'il faut retenir
HTTP est un protocole stateless : chaque requête est indépendante.
Les cookies permettent au navigateur de conserver un identifiant de session.
Les sessions sont stockées côté serveur.
Laravel utilise les sessions pour mémoriser l'utilisateur connecté.
Les Flash Sessions permettent d'afficher des messages temporaires.
Les messages Flash sont très utilisés après une création, une modification ou une suppression de données.


--- Les bonnes pratiques
Stocker uniquement des informations utiles dans la session.
Utiliser les Flash Sessions pour les messages de confirmation.
Ne jamais stocker d'informations sensibles dans les cookies.
Afficher les messages Flash de manière claire et cohérente dans toutes les vues.


--- Les erreurs fréquentes
Confondre cookies et sessions.
Penser que la session est stockée dans le navigateur.
Conserver des informations temporaires dans une session classique au lieu d'utiliser une Flash Session.
Oublier d'afficher les messages Flash dans les vues.


*/