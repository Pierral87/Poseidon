<?php 

/* 

--- TP Jour 1 Bibliotheque - Relations - Module Auteurs & Livres ---
Bibliotheque : 

Objectif : 
    Mettre en pratique : 
        Les notions abordées en S1
        Les relations OneToMany ManyToOne
        Les validations de formulaires 
        Load des datas au travers de la relation


Spécifications des Entités :
- Entité Author (Auteur)
    id : Identifiant unique
    last_name : Nom (obligatoire, string)
    first_name : Prénom (obligatoire, string)
    email : Adresse email (obligatoire, email unique)
    phone : Téléphone (optionnel, string)
    timestamps

- Entité Book (Livre)
    id : Identifiant unique
    title : Titre du livre (obligatoire, min. 3 caractères, max. 255)
    author_id : Clé étrangère pointant vers la table authors
    timestamps

1. Création de l'entité Author :
Migration : en rapport avec la modélisation
Modèle : bien définir les fillables, préparer la méthode de relations pour récupérer les books liés à cet auteur
Factory & Seeder à mettre en place
Controller : CRUD complet, mettre en place des validations de données dans store() et update()

2. Création de l'entité Book & Liaison avec foreign key 
Migration : Ne pas oublier la spécification de la foreign key 
Modèle : bien définir les fillables et définir la méthode pour la relation
Controller : CRUD complet, récupération des auteurs pour les afficher dans l'index mais aussi placer dans un champ select à la création d'un nouveau livre, mettre en place des validations pour store et update 

3. Peuplez la BDD avec les factories et seeders

4. Intégration des vues, forms, @errors

5. Tout le système doit être fonctionnel avec le crud des auteurs et le crud des livres incluant la relation

Bonus : dans le show author, afficher le nombre de livres publiés par cet auteur ainsi que leur liste


*/