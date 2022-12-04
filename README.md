# BTS-SIO-ALT-G1-2023-AutoEcole-Web

## Initialisation du projet 

1. Copier un fichier .env
Faire un copier/coller du fichier exemple.env

2. Composer
installation des librairies du projet
```
composer install
```
3. Mettez le lien vers votre service docker et renommez comme vous voulez la bdd 

## Developpement de la base de donnée

1. Changement de la structure de la base via ORM
```
symfony console make:migration
symfony console d:m:m
```

2. Reception d'un commit qui opere un changement de structure
```
symfony console d:m:m
```

## Pour les fixtures 
Les fixtures se font dans l'odre donc faite simplement la commande :
```
symfony console d:f:l
```