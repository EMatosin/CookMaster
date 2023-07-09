# CookMaster
Projet Annuel 2A1

Lien Trello : https://trello.com/b/ppFoQxn5/projet-annuel-cookfusion
Lien GlooMaps (Arborescence Web) : https://www.gloomaps.com/MwmlNrHx9C

Android :

- API fonctionnel qui permet de dialoguer avec une BDD en localhost --> nécessite de simuler l'application via Android Studio et un serveur Wamp ouvert (a voir si on pourra connecter à une bdd en distant)
- Application composé pour l'instant de:
    - Une fenetre de connexion et inscription qui permet de vérifier des infos ou d'ne inscrire dans la bdd en localhost (bien créer la table users et les lignes en amont !)
    - Une interface comprenant 4 fragments génériques pour le moment, avec un menu déroulant à gauche et un menu en dessous qui redirige vers les fragments
    - Sur l'un des fragments se situe une LIstView qui permet l'affichage de quelques aliments et une description plus complète de ceux ci lors d'une interaction (a répéter sur les autres fragments avec par exemple une ListView pour les différents locaux proposés, les différents chefs disponibles etc..)

 A FAIRE
 
- NFC en cours avec  MF2A et/ou fidélisation via tampons 
- Ajout d'une fonctionnalité pour prendre en photo et upload une image (par exemple upload un plat et le save qq part ou bien upload des documents administratifs tel que un certificat pour prouver l'authenticité du diplome d'un chef cuisinier...)

Java :

- Classes principales crées contenant de nombreuses spécificitées via JOKER ou données pré enregistrées
- Génération de PDF aléatoires via listes crées en amont pour différents utilisateurs avec de nombreuses spécificités (devis, facture, evenement, abonnement etc...) avec la librairie iTextPdf
- Génération de différents charts via la librarie JFreeChart
- Interface extremement simple (un seul bouton) via JavaFX pour avoir une interface utilisateur qui génère le PDF

C :

- Requeteur d'API fonctionnel et utilisant la librarie SDL

A FAIRE

- Rajouter des champs pour des mots clés et des clés (?)

