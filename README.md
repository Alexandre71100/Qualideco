# Qualideco

Projet Qualideco

Equipe : • Alexandre Da Silva • Anas Abou Shaar • Chakib Assani

# Installation
Cloner le projet et exécuter les lignes de commandes suivantes :

>Bien se placer dans le dossier du projet avant d'utiliser ces commandes !

* composer install
* symfony console doctrine:database:create
* symfony console make:migration
* symfony console doctrine:migration:migrate
* symfony console doctrine:fixtures:load
* npm install
* npm run build

# Mise à jour
* composer install
* symfony console doctrine:schema:update --force
* npm install
* npm run build
