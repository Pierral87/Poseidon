<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 19 - Les Relations Eloquent 
----------------------------------------------------------------------------

--- Pourquoi les relations existent ?
Dans une base de données relationnelle, les informations sont réparties dans plusieurs tables afin d'éviter les duplications de données et de faciliter leur maintenance.

Prenons l'exemple de notre bibliothèque.

Un utilisateur possède un rôle :
admin
staff
abonne

Une première idée pourrait être d'écrire directement le nom du rôle dans chaque utilisateur.
id	nom	rôle
1	Alice	Administrateur
2	Bob	Abonné
3	Claire	Abonné

Cette solution fonctionne, mais elle présente plusieurs inconvénients.

Si le nom d'un rôle change, il faudra modifier tous les utilisateurs concernés. De plus, rien n'empêche d'écrire des valeurs différentes comme "admin", "Administrateur" ou encore "ADMIN", ce qui crée rapidement des incohérences.

Une meilleure solution consiste à créer une table dédiée aux rôles et à faire simplement référence à cette table.

roles
id
name

Puis :
users
id
name
role_id

Chaque utilisateur mémorise uniquement l'identifiant de son rôle.

Cette organisation permet :
d'éviter les doublons ;
de garantir l'intégrité des données ;
de faciliter les modifications ;
de créer facilement des liens entre les tables.

C'est ce principe qui est à la base des relations dans une base de données relationnelle.

--- Les clés étrangères
Une clé étrangère (Foreign Key) est une colonne qui contient l'identifiant d'un enregistrement présent dans une autre table.

Dans notre projet :
roles
id = 1
Administrateur

users
name = Pierre
role_id = 1

La colonne role_id indique que cet utilisateur est lié au rôle dont l'identifiant est 1.

Une clé étrangère permet donc de relier plusieurs tables entre elles tout en garantissant la cohérence des données.

Laravel facilite énormément la création des clés étrangères grâce aux migrations.

Exemple :
$table->foreignId('role_id')->constrained();
Cette instruction crée automatiquement la colonne role_id ainsi que la contrainte de clé étrangère correspondante.

--- La relation belongsTo()
La méthode belongsTo() est utilisée lorsqu'un modèle "appartient" à un autre modèle.

Dans notre exemple :
un utilisateur appartient à un rôle.

Autrement dit :
User
    ↓
 Role

La relation est définie dans le modèle User.
public function role()
{
    return $this->belongsTo(Role::class);
}

La règle est simple :
Le modèle qui possède la clé étrangère utilise toujours belongsTo().
Dans notre cas, c'est bien la table users qui possède la colonne role_id.

--- La relation hasMany()
La méthode hasMany() est utilisée lorsqu'un modèle possède plusieurs enregistrements liés.

Dans notre projet :
un rôle peut être attribué à plusieurs utilisateurs.
Role
   ↓
Users

La relation est définie dans le modèle Role.
public function users()
{
    return $this->hasMany(User::class);
}

Grâce à cette relation, il devient très simple de récupérer tous les utilisateurs possédant un rôle donné.

--- La relation hasOne()
La méthode hasOne() est utilisée lorsqu'un modèle possède un seul enregistrement associé.

Par exemple :
User
   ↓
Profile

ou

User
   ↓
LibraryCard

Dans ce cas, chaque utilisateur possède une seule carte de bibliothèque.

La relation se définit de la manière suivante :
public function card()
{
    return $this->hasOne(Card::class);
}

Même si nous n'utiliserons pas cette relation dans notre projet, il est important de connaître son fonctionnement.


--- Accéder aux relations
Une fois les relations définies, Laravel permet d'accéder directement aux données liées.

Par exemple :
$user->role
retourne automatiquement le rôle de l'utilisateur.

De la même manière :
$role->users
retourne tous les utilisateurs possédant ce rôle.

Cette écriture rend le code beaucoup plus lisible et évite d'écrire manuellement des requêtes SQL complexes.

--- Le chargement des relations avec with()
Lorsque plusieurs relations doivent être utilisées, Laravel permet de les charger directement avec la méthode with().

Exemple :
$users = User::with('role')->get();
Laravel récupère alors les utilisateurs ainsi que leurs rôles en une seule opération.
Cette méthode est particulièrement utile lorsque l'on sait que les données liées seront utilisées dans la vue.


--- Lazy Loading et Eager Loading
Laravel propose deux façons de charger une relation.


--- Lazy Loading
Le Lazy Loading consiste à charger la relation uniquement lorsqu'elle est demandée.

Exemple :
$users = User::all();
foreach ($users as $user)
{
    echo $user->role->name;
}

Dans ce cas, Laravel récupère les rôles uniquement lorsque le code accède à la propriété role.
Cette méthode est simple à utiliser mais peut entraîner un grand nombre de requêtes lorsque beaucoup d'enregistrements sont parcourus.


--- Eager Loading
Le Eager Loading consiste à charger immédiatement les relations grâce à la méthode with() (ou load()).
$users = User::with('role')->get();
Toutes les données nécessaires sont récupérées dès le départ.
Cette méthode est généralement plus performante lorsqu'une relation sera utilisée pour plusieurs enregistrements.


--- Ce qu'il faut retenir
Une relation permet de relier plusieurs tables entre elles.
Une clé étrangère contient l'identifiant d'un enregistrement situé dans une autre table.
Le modèle qui possède la clé étrangère (enfant) utilise belongsTo().
Le modèle qui possède plusieurs éléments (parent) liés utilise hasMany().
hasOne() est utilisé lorsqu'un seul enregistrement est associé.
La méthode with() permet de charger les relations dès la récupération des données.
Les relations rendent le code plus lisible et limitent le nombre de requêtes SQL à écrire.


--- Les bonnes pratiques
Toujours utiliser les relations Eloquent plutôt que de multiplier les requêtes SQL manuelles.
Respecter les conventions de nommage (role_id, author_id, etc.).
Utiliser with() lorsque l'on sait que la relation sera affichée.
Donner des noms de méthodes explicites (role(), users(), author(), books()).
Toujours réfléchir au sens de la relation avant de choisir entre belongsTo() et hasMany().


--- Les erreurs fréquentes
Inverser belongsTo() et hasMany().
Oublier de créer la clé étrangère dans la migration.
Nommer incorrectement la clé étrangère (id_role au lieu de role_id).
Oublier d'utiliser with() lorsqu'une relation est utilisée pour une liste importante d'enregistrements.
Penser qu'une relation crée automatiquement les données : elle ne fait que décrire le lien entre les modèles.
*/