<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 32 — Les Notifications
----------------------------------------------------------------------------

--- Pourquoi les Notifications existent ?
Dans le chapitre précédent, nous avons découvert les Mailables, qui permettent de créer et d'envoyer des e-mails.

Cette solution est parfaitement adaptée lorsqu'un message est destiné à être envoyé uniquement par e-mail.

Cependant, dans une application moderne, une même information peut être transmise de plusieurs façons.

Prenons l'exemple de notre bibliothèque.

Lorsqu'un emprunt arrive bientôt à échéance, nous pourrions prévenir l'utilisateur :
par e-mail ;
par une notification dans l'application ;
par SMS ;
ou encore via un autre service de messagerie.

Si nous utilisions uniquement des Mailables, il faudrait réécrire une partie du code pour chaque nouveau moyen de communication.

Les Notifications ont été créées pour résoudre ce problème.

Elles représentent une information à transmettre, indépendamment du moyen utilisé pour la diffuser.


--- La différence entre Mail et Notification
Les Mailables et les Notifications poursuivent un objectif proche, mais leur philosophie est différente.

Un Mailable représente directement un e-mail.

Il contient :
le sujet ;
le contenu ;
la vue Blade utilisée ;
les éventuelles pièces jointes.

Une Notification, quant à elle, représente un message destiné à un utilisateur.

Elle ne se limite pas à l'e-mail.

Elle peut être envoyée par différents canaux selon les besoins de l'application.

En résumé :
Mailable = un e-mail
Notification = une information à transmettre


--- Les canaux disponibles
Laravel permet d'envoyer une Notification par plusieurs canaux.

Parmi les plus courants, on retrouve :
l'e-mail ;
les notifications enregistrées en base de données ;
les notifications en temps réel (Broadcast) ;
Slack ;
les SMS via certains fournisseurs.

Le développeur choisit simplement les canaux qu'il souhaite utiliser.

La logique de la Notification reste la même.

Dans notre projet, nous utiliserons uniquement le canal e-mail.


--- Les Notifications par e-mail
Une Notification peut être envoyée par e-mail.

Laravel construit alors automatiquement le message à partir de la classe Notification.

Contrairement aux Mailables, il n'est pas nécessaire de créer une vue Blade.

Laravel fournit une mise en page par défaut contenant :
un titre ;
un texte ;
un bouton d'action ;
un message de conclusion.

Cette solution permet de créer rapidement des e-mails simples et cohérents.

Pour des e-mails très personnalisés ou graphiques, il reste préférable d'utiliser un Mailable.



--- Ce qu'il faut retenir
Une Notification représente une information destinée à un utilisateur.
Une Notification peut être envoyée par différents canaux.
Un Mailable est spécialisé dans l'envoi d'e-mails.
Laravel fournit plusieurs canaux de Notification, dont l'e-mail.
Les Notifications permettent de faire évoluer facilement une application sans modifier toute la logique d'envoi.


--- Les bonnes pratiques
Utiliser un Mailable lorsque le message est uniquement destiné à être envoyé par e-mail.
Utiliser une Notification lorsqu'un même message peut être diffusé par plusieurs canaux.
Choisir le canal le plus adapté aux besoins de l'application.
Donner un contenu clair et concis aux notifications.
Centraliser la logique de notification dans des classes dédiées.


--- Les erreurs fréquentes
Confondre Mailable et Notification.
Utiliser une Notification alors qu'un simple Mailable serait suffisant.
Penser qu'une Notification envoie automatiquement un e-mail : c'est le canal choisi qui détermine le mode d'envoi.
Vouloir personnaliser fortement la présentation d'une Notification alors qu'un Mailable serait plus adapté.
Oublier qu'une Notification peut être réutilisée avec plusieurs canaux sans modifier sa logique.


*/