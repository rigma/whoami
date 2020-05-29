# Qui suis-je ?

Exercice de programmation réalisé pour un entretien avec [Studapart](https://www.studapart.com/fr).
Le but de l'exercice était de réaliser les tâches suivantes :

- un formulaire d'inscription
- un formulaire de connexion
- une page pour afficher des informations personnelles saisies lors de l'inscription

## Lancement de l'application

Pour lancer l'application, vous aurez besoin de [Docker](https://docker.com) et [Docker Compose](https://docs.docker.com/compose/).
Si vous n'avez pas ces logiciels, installez les avant de continuer.

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

_à écrire_

## Licence

C'est un exercice pour montrer mes compétences techniques, si vous trouvez une utilité dans ce code, je vous en prie : servez-vous.
