# TomTroc

Afin de pouvoir accéder à l'application et à toutes ses fonctionnalités, vous aurez besoin d'une base SQL déjà fournie. Pour vous faciliter l'accès, vous trouverez une base de données ainsi que ses différentes tables dans le dossier "SQL". 

Veuillez suivre ces étapes :

1.Téléchargez la base de données présente dans le dossier "SQL".

2.Ouvrez phpMyAdmin, créez une nouvelle Database que vous appellerez "tomtroc".

3.Cliquez sur "Import", sélectionnez la base de donnée téléchargée dans l'étape 1. Une fois fait, vous devriez retrouver 4 Tables ("book", "conversations", "messages" et "users").

4.Téléchargez désormais l'ensemble du code de l'application TOMTROC. 

5.Ouvrez l'ensemble du projet dans un Editeur de code et modifier le fichier appellé "_config.php" situé dans le dossier config.

6.Dans ce fichier, indiquez les informations permettant d'accéder à votre base de données. Voici un exemple que vous pouvez copier/coller afin d'accélerer le processus: 

            SetEnv DB_HOST localhost
            SetEnv DB_NAME tom_troc  
            SetEnv DB_USER root (remplacez "root" par votre nom d'utilisateur permettant la connexion à phpMyAdmin)
            SetEnv DB_PASS "" (remplacez "" par votre mot de passe)


7. Renommer ensuite le fichier _config.php en config.php
8. 
9. Lancez le projet à l'aide de XAMP ou WAMP selon vos préférences !