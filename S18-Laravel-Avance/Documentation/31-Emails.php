<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 31 — Les Emails
----------------------------------------------------------------------------

--- Pourquoi envoyer des e-mails ?
Les e-mails sont présents dans la majorité des applications web.

Ils permettent d'informer automatiquement les utilisateurs lorsqu'un événement important se produit.

Par exemple :
création d'un compte ;
réinitialisation d'un mot de passe ;
confirmation d'une commande ;
validation d'une réservation ;
rappel d'un emprunt dans notre bibliothèque.

Plutôt que d'écrire manuellement le contenu de chaque message, Laravel propose un système complet permettant de créer, personnaliser et envoyer des e-mails de manière simple.

--- La configuration
Pour envoyer un e-mail, Laravel doit communiquer avec un serveur de messagerie.

Cette communication s'effectue grâce au protocole SMTP (Simple Mail Transfer Protocol).

Les informations nécessaires sont configurées dans le fichier .env.

On y retrouve notamment :
l'adresse du serveur SMTP ;
le port utilisé ;
les identifiants de connexion ;
l'adresse d'expédition.

En développement, il n'est pas souhaitable d'envoyer de véritables e-mails. On utilise donc généralement un serveur SMTP local.


--- Maildev
Maildev est un faux serveur SMTP destiné au développement.

Au lieu d'envoyer réellement les e-mails, il les intercepte et les affiche dans une interface web.

Cela permet de vérifier :
le contenu des messages ;
leur mise en page ;
les pièces jointes ;
les destinataires.

L'application fonctionne exactement comme en production, mais aucun e-mail n'est réellement envoyé.

Maildev est donc un excellent outil pour développer et tester les fonctionnalités liées à la messagerie.

--- Les Mailables
Dans Laravel, chaque type d'e-mail est représenté par une classe appelée Mailable.

Cette classe décrit entièrement l'e-mail :
son sujet ;
les données qu'il reçoit ;
la vue Blade utilisée ;
les éventuelles pièces jointes.

Chaque Mailable représente donc un type précis de message.

Par exemple :
un e-mail de bienvenue ;
un rappel d'emprunt ;
une confirmation d'inscription.

Cette organisation rend le code plus clair et facilite la maintenance de l'application.


--- Les vues Blade
Le contenu d'un e-mail est généralement construit à l'aide d'une vue Blade.

Le principe est exactement le même que pour les pages HTML de l'application.

Les variables peuvent être affichées avec la syntaxe Blade habituelle.

Il est ainsi possible de personnaliser chaque message en fonction des informations reçues, comme le nom de l'utilisateur ou le titre d'un livre emprunté.

Cette réutilisation de Blade permet d'unifier la manière de construire les interfaces web et les e-mails.


--- Les pièces jointes
Laravel permet également d'ajouter des pièces jointes aux e-mails.

Il peut s'agir par exemple :
d'un règlement intérieur ;
d'une facture au format PDF ;
d'un contrat ;
d'un document généré automatiquement.

Les pièces jointes sont définies directement dans la classe Mailable.

Laravel se charge ensuite de les intégrer au message lors de l'envoi.


--- L'envoi d'un e-mail
L'envoi d'un e-mail s'effectue grâce à la façade Mail.
Exemple :  Mail::to($user->email)->send(new WelcomeMail($user));
Il suffit d'indiquer :
le destinataire ;
le Mailable à envoyer.

Laravel construit automatiquement le message, génère la vue Blade correspondante puis l'envoie au serveur SMTP configuré.

Le développeur n'a donc pas besoin de manipuler directement le protocole SMTP.


--- Ce qu'il faut retenir
Laravel utilise le protocole SMTP pour envoyer des e-mails.
En développement, Maildev permet de tester les envois sans contacter un véritable serveur de messagerie.
Chaque type d'e-mail est représenté par une classe Mailable.
Les Mailables utilisent des vues Blade pour générer leur contenu.
Il est possible d'ajouter des pièces jointes à un e-mail.
La façade Mail permet d'envoyer facilement les messages.


--- Les bonnes pratiques
Créer un Mailable différent pour chaque type d'e-mail.
Utiliser des vues Blade afin de séparer la présentation de la logique métier.
Tester systématiquement les e-mails avec Maildev pendant le développement.
Donner des sujets explicites aux messages.
Personnaliser les e-mails avec les informations de l'utilisateur afin d'améliorer leur lisibilité.


--- Les erreurs fréquentes
Oublier de configurer correctement le serveur SMTP dans le fichier .env.
Envoyer directement des e-mails réels pendant les phases de développement.
Mélanger la logique métier avec la construction de l'e-mail.
Réutiliser le même Mailable pour plusieurs messages ayant des objectifs différents.
Oublier de transmettre les données nécessaires à la vue Blade.
*/