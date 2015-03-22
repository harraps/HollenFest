HollenFest
========================

Création d'un site de running order pour un hellfest (2013 - 2014 - 2015)

1) Plan du projet
----------------------------------

### Dans le navigateur

Pour voir la page principale, il faut taper l'adresse suivante
    localhost/HollenFest/web/app_dev.php/

### Les repertoires

Symfony fonctionne avec plusieurs répertoires

 * app
    fichiers de configuration
 * bin
    /!\ ne pas toucher
 * src
    fichiers sources (ce qu'on doit modifier)
 * vendor
    les bundles tiers, /!\ ne pas toucher
 * web
    les fichiers js, css, etc global au site

### Les commandes

Pour utiliser les commandes, il faut ouvrir un terminal à la racine du projet
À chaque synchronisation du projet, il faut mettre à jour les bundles tiers

 * pour mettre à jour les bundles tiers
    php composer.phar update
 * pour créer un bundle
    php app/console generate:bundle
 * pour créer la base de données
    php app/console doctrine:database:create
 * pour créer une entity
    php app/console generate:doctrine:entity
 * pour visioner les requètes produites pour mettre à jour la base de données
    php app/console doctrine:schema:update --dump-sql
 * pour créer le schéma de base de données
    php app/console doctrine:schema:update --force

2) Directive
-------------------------------------

### Composition
Le site devra comporter:
- une page d'accueil
- le planning général
- une page d'inscription/connexion
- proposer un moyen de reserver les places

Quand on est connecté, on doit pouvoir marquer les groupes qui nous intérêssent et l'application web doit se charger de nous créeer un running order optimal
Il faut prévoir aussi des pauses pour manger (15 - 30 - 60 min)
Le running order généré doit être exportable en PDF


### Concept
Vous devez réaliser le site présentant le Running Order du Hëllefest 2015.
Le Hëllefest se tient sur 3 jours : vendredi, samedi et dimanche, de 10h à 3h du matin. 
Un running order se compose d’un ordre de passage des groupes par scènes.
Le Hëllefest se compose de 6 scènes qui jouent en alternance.
Vous trouverez des exemples d’un festival francais dans le dossier du sujet Vous pouvez reprendre les mêmes noms de groupes ou pas.
Un groupe a un nom, un style et joue une fois sur les 3 jours. Il joue à un horaire défini.


### Fonctionnalités
Vous devez présenter de manière lisible l’emploi du temps de chaque scène pour chaque jour.
Vous pouvez vous inspirer des running order existants.
Vous devez proposer une interface administrateur permettant d’ajouter ou de supprimer des groupes à un horaire donné sur une scene donnée.
Cette interface devra être protegée (a vous de définir comment)
Les visiteurs peuvent se créer un compte.
Une fois connectés ils pourront faire des recherches pour trouver quel groupe joue à quelle heure, ou tous les groupes d’un style donné.
Il pourra ensuite signaler qu’il veut aller voir ce groupe. Il ne peut pas choisir deux groupes qui jouent en même temps.
L’utilisateur peut visualiser son running order personnalisé : celui qui présente que les groupes qu’il veut voir. 
A vous de définir la manière de le visualiser  mais cela doit être facile à imprimer.

Exemple de fonctionnalités attendues : 
- L’utilisateur veut voir tous les groupes de black metal du vendredi
- L’utilisateur peut voir le running order du vendredi, du samedi ou du dimanche. Il peut aussi visualiser les 3 d’un coup
- Par défaut, il voit toutes les scènes mais peut choisir de n’en voir qu’une.
- Il peut définir qu’il ne veut voir les groupes que sur une certaine plage horaire.
- L’administrateur peut visualiser le running order.
- Il peut ajouter un groupe si il y’a une place (attention, il faut laisser au minimum 20 minutes entre deux groupes pour changer le matos sur une même scène !!! )
- Il peut supprimer un groupe.

### Contraintes techniques
Vous devrez utiliser une base de données. 
Les communications entre votre application et la base de donnée devront passer par un ORM, Hibernate si vous êtes en Java.
Votre site devra respecter les bonnes pratiques en terme d’IHM, et être intuitif pour l’utilisateur. 
Vous devrez respecter le pattern MVC, et utiliser des webservices REST pour les dialogues entre votre vue et votre controller.
Si vous codez en Java, les JSP ou les JSF sont recommandées. 
Votre projet devra être un projet Maven si vous utilisez du java.
Un rapport Sonar est attendu dans votre rapport.
Vous pouvez vous baser sur des projets open-source, mais vous devrez les citer.


### Fonctionnalités facultatives : 
L’utilisateur peut définir le temps de chevauchement de deux groupes. 
Vous pouvez définir une réelle identité visuelle pour votre site (CSS, bannière, etc) et proposer un design qui s’adapte suivant la taille de l’écran ou le média. Bref un Responsive Design.
Proposez des options pour sécuriser votre interface d’administration.
Lorsqu’un admin modifie un groupe ou un horaire de passage, les utilisateurs l’ayant selectionné sont prevenus (mail, sms, autre … ) 
