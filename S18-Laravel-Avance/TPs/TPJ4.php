<?php 

/* 

--- TP Jour 4 (Final) : Corbeille, Pagination & Relances par Email


Finaliser l'interface d'administration de la bibliothèque en ajoutant trois fonctionnalités :

    Le Soft Delete (suppression douce) : Permettre l'archivage temporaire des livres sans les effacer physiquement de la base de données.

    La Pagination : Optimiser l'affichage des listes d'ouvrages et de la corbeille.

    Les Relances par Email : Permettre au personnel de relancer un adhérent en retard d'un simple clic depuis le tableau de bord.


----- Etapes : 

--- Étape 1 : Activation du Soft Delete sur les Livres

    Migration : Créez une nouvelle migration pour ajouter la colonne nécessaire à la gestion de la suppression douce sur la table des livres.

    Modèle : Configurez le modèle Book pour qu'il prenne en compte le comportement de suppression douce.

    Comportement attendu : Désormais, lorsqu'un utilisateur supprime un livre depuis l'interface, celui-ci doit être masqué de l'application tout en restant conservé en base de données avec sa date d'archivage.


--- Étape 2 : Pagination & Gestion de la Corbeille

    Pagination de la liste principale :

        Modifiez l'action qui affiche la liste des livres pour limiter l'affichage à 5 éléments par page.

        Dans la vue d'index des livres, ajoutez les composants de navigation permettant de passer d'une page à l'autre.

    Route et Contrôleur pour la Corbeille :

        Déclarez une nouvelle route /books/trash (accessible uniquement par les rôles admin et staff).

        Créez la méthode de contrôleur associée pour récupérer uniquement les livres archivés (supprimés de manière douce), eux aussi paginés par 5.

    Vue Corbeille :

        Créez la vue d'affichage de la corbeille.

        Pour chaque livre archivé présent dans le tableau, proposez deux actions distinctes :

            Restaurer : Réintègre le livre dans la liste principale des ouvrages.

            Supprimer définitivement : Efface définitivement la ligne de la base de données.

            
--- Étape 3 : Relance d'Emprunt par Email

    Création de la classe d'Email (Mailable) :

        Générez une nouvelle classe Mailable dédiée au rappel d'emprunt.

        Transmettez-lui les informations nécessaires (l'emprunt concerné, l'utilisateur et le livre) pour pouvoir les utiliser dans la vue.

    Gabarit du Mail :

        Rédigez le message de relance en HTML en y incluant dynamiquement :

            Le nom de l'emprunteur.

            Le titre du livre concerné.

            Un message lui demandant de rapporter l'ouvrage à la bibliothèque dans les meilleurs délais.

    Route & Action de Relance :

        Créez une route (ex: POST /loans/{loan}/remind) pointant vers une nouvelle méthode du contrôleur des emprunts.

        Cette méthode doit déclencher l'envoi de l'email à l'adresse de l'emprunteur, puis recharger la page en affichant un message flash de confirmation.

    Interface d'administration :

        Dans la liste des emprunts, ajoutez un bouton "Relancer" en face de chaque emprunt qui n'a pas encore été restitué.

*/