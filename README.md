# Qui suis-je ?

Exercice de programmation réalisé pour un entretien avec [Studapart](https://www.studapart.com/fr).
Le but de l'exercice était de réaliser les tâches suivantes :

- un formulaire d'inscription
- un formulaire de connexion
- une page pour afficher des informations personnelles saisies lors de l'inscription

## Lancement de l'application

Pour lancer l'application, vous aurez besoin de [Docker] et [Docker Compose]. Si vous n'avez pas ces logiciels, installez les avant
de continuer.

Une fois que c'est fait, utiliser la commande suivante :

```sh
$ docker-compose up
```

`docker-compose` va s'occuper de construire les images `api` et `whoami` et de les lancer avec une base de données PostgreSQL. Une
fois que c'est fait, vous pouvez accéder à l'application avec l'URL [http://localhost:8000](http://localhost:8000).

> Les ports 8000 et 8001 de votre machine ne doivent pas être utilisés pour pouvoir lancer correctement l'application.

`docker-compose` va construire seulement une fois les images requises pour lancer le "cluster" du `docker-compose`. Elles seront
gardés en cache par `docker` pour le prochain lancement.

## A propos de l'architecture

Pour réaliser cet exercice, j'ai fait le choix de mettre en place deux "microservices" séparés : un se chargeant de gérer les requêtes
d'authentification et les diverses communications avec la base de données au moyen d'une API REST, l'autre ne s'occupe que de l'interaction
avec l'utilisateur à l'aide d'une interface graphique réaliser avec [Vue.js] servie grâce à un serveur [NGINX].

De fait, le mécanisme d'authentification se repose sur l'utilisation de jeton JWT, suivant la norme [RFC 7519], qui permettent à l'API
de savoir si elle doit traiter la demande de l'utilisateur qui fait la requête HTTP à l'aide du [module de sécurité] de Symfony.

Une autre approche aurait été d'utiliser les sessions PHP classiques mais j'ai estimé que découpler les deux services afin de les isoler
permet de concerver [le principe SRP] et d'éviter d'avoir à prévoir des contrôleurs dédiés à l'affichage des interfaces graphique dans le
service Symfony qui peut "se concentrer" sur la gestion des requêtes d'APIs et de communiquer avec la base de données.

Toutefois une critique qu'on peut faire de cette approche est qu'elle repose sur des services interdépendants : l'interface graphique ne peut
fonctionner sans son API pour lui fournir ses données. Il faut donc une plus grande rigueur dans le maintien de ce choix d'architecture.

## Licence

C'est un exercice pour montrer mes compétences techniques, si vous trouvez une utilité dans ce code, je vous en prie : servez-vous.

[Docker]: https://docker.com
[Docker Compose]: https://docs.docker.com/compose/
[Vue.js]: https://vuejs.org
[NGINX]: https://nginx.org/en/
[RFC 7519]: https://tools.ietf.org/html/rfc7519
[module de sécurité]: https://symfony.com/doc/current/security.html
[le principe SRP]: https://en.wikipedia.org/wiki/Single-responsibility_principle
