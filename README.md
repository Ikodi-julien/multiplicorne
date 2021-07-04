# Multiplicorne

Multiplicorne est une application de révision des opérations mathématiques de base (addition, soustraction et multiplication) destinée aux enfants de 6 à 12 ans.
L'utilisateur, connecté ou non, peut faire différentes courses. Pour gagner une course il faut faire avancer son personnage vers la ligne d'arrivée en donnant la réponse juste aux opérations proposées.
Il y a deux types de courses, les sprints ou les marathons. Pour gagner un sprint il faut répondre juste à 10 opérations. Pour gagner un marathon il faut répondre juste à 80 opérations.

Si l'utilisateur n'est pas connecté, il peut faire toutes les courses mais :
 - son temps ne sera pas personnalisé et sera enregistré sous le nom 'visiteur',
 - il ne peut pas changer le thème visuel,
 - il ne peut pas changer d'avatar,
Un utilisateur connecté peut :
 - enregistrer ses temps sous son nom,
 - choisir un thème visuel depuis son espace membre,
 - choisir un avatar (parmis une liste),
 - voir le récapitulatif de ses derniers temps triés dans la page 'Temps'.

### Un peu d'histoire
Quand j'ai commencé à apprendre à coder, j'ai débuté avec Python. Un des exercices consistait à écrire un bout de code permettant d'afficher en console la table de multiplication d'un nombre donné.
A cette époque (fin 2019), ma fille avait 9 ans, était en CE2 et avait le niveau de rantanplan en table de multiplication...
Alors pour faire passer un peu plus facilement la pilule (et aussi pour mettre en pratique ce que j'apprenais en dèveloppement web), j'ai commencé à créer un site ou elle devrait faire avancer une licorne vers une ligne d'arrivée en répondant juste à des multiplications.
Aujourd'hui, c'est le thème 'neutre' par défaut qui est utilisé mais on peut créer un compte et choisir le thème 'rose' avec l'avatar 'licorne' pour voir ce qui a motivé ma fille...
En 2021, la semaine dernière, ma fille a fini le marathon des multiplications (toutes les tables mélangées) en 3mn et 11s, soit moins de 2.5s par réponse... et vous ? :-)

## Stack technique

## Setup

## Versionning

### V8 Multiplicorne	14/03/2021
- Ajout de courses additions et soustraction sprint et marathon,
- Bundle JS avec webpack, CSS avec SCSS,
- Modification JS, PHP, SQL, BDD pour enregistrer des secondes et non le temps en string.
- Modification de l'architecture de la BDD
- Affichage des temps plus détaillé et complet
- Landing sur l'index des courses, connexion si on veut.


### V7 Multiplicorne	22/10/20
- Amélioration affichage espace membre → ok	
- Amélioration affichage multiplication → ok	
- Version avec voiture pour garçon → ok	
- Ajout page info confidentialité → ok	
- Footer digne de ce nom → ok	
- Balise met pour SEO → ok	
- Ajout formulaire de contact → ok	
- Faire décor neutre et décor moins lumineux → ok	
- Possibilité d'enregistrer le temps en visiteur	28/10/20
