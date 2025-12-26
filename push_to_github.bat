@echo off
echo ========================================
echo   PUSH RES-SPORTS TO GITHUB
echo ========================================
echo.

REM Vérifier si Git est installé
git --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERREUR] Git n'est pas installé ou n'est pas dans le PATH
    echo Veuillez installer Git depuis https://git-scm.com/
    pause
    exit /b 1
)

echo [OK] Git est installé
echo.

REM Vérifier si c'est un repository Git
if not exist ".git" (
    echo [INFO] Initialisation du repository Git...
    git init
    echo [OK] Repository Git initialisé
) else (
    echo [OK] Repository Git déjà initialisé
)

echo.

REM Vérifier la configuration Git
for /f "tokens=*" %%i in ('git config --global user.name') do set GIT_USER=%%i
for /f "tokens=*" %%i in ('git config --global user.email') do set GIT_EMAIL=%%i

if "%GIT_USER%"=="" (
    echo [ATTENTION] Nom d'utilisateur Git non configuré
    echo Configurez votre nom : git config --global user.name "Votre Nom"
)

if "%GIT_EMAIL%"=="" (
    echo [ATTENTION] Email Git non configuré
    echo Configurez votre email : git config --global user.email "votre.email@example.com"
)

if "%GIT_USER%"=="" or "%GIT_EMAIL%"=="" (
    echo.
    echo Veuillez configurer Git avant de continuer.
    pause
    exit /b 1
)

echo [OK] Configuration Git trouvée - %GIT_USER% ^<%GIT_EMAIL%^>
echo.

REM Ajouter le repository distant
echo [INFO] Configuration du repository distant...
git remote remove origin 2>nul
git remote add origin https://github.com/AmineGR03/res-sports.git
echo [OK] Repository distant configuré
echo.

REM Créer un fichier .gitignore s'il n'existe pas
if not exist ".gitignore" (
    echo [INFO] Création du fichier .gitignore...
    echo # Laravel > .gitignore
    echo /vendor/ >> .gitignore
    echo /node_modules/ >> .gitignore
    echo .env >> .gitignore
    echo .env.local >> .gitignore
    echo storage/app/* >> .gitignore
    echo storage/framework/cache/* >> .gitignore
    echo storage/framework/sessions/* >> .gitignore
    echo storage/framework/views/* >> .gitignore
    echo storage/logs/* >> .gitignore
    echo bootstrap/cache/* >> .gitignore
    echo [OK] Fichier .gitignore créé
) else (
    echo [OK] Fichier .gitignore déjà présent
)

echo.

REM Ajouter tous les fichiers
echo [INFO] Ajout des fichiers au repository...
git add .
echo [OK] Fichiers ajoutés
echo.

REM Créer le commit initial
echo [INFO] Création du commit initial...
git commit -m "Initial commit - Res-Sports application

🎯 Application de réservation de terrains sportifs

✨ Fonctionnalités principales :
- Gestion complète des utilisateurs (admin/client)
- Catalogue de terrains sportifs avec images
- Système de réservation avec calcul automatique des prix
- Gestion des équipements sportifs
- Interface d'administration moderne
- Authentification et autorisations sécurisées

🛠️ Technologies utilisées :
- Laravel 10 (PHP 8.1+)
- MySQL/MariaDB
- Tailwind CSS
- Vite.js

📋 Pour l'installation, consultez INSTALLATION_GUIDE.md"

if %errorlevel% neq 0 (
    echo [ATTENTION] Le commit a échoué. Vérifiez s'il y a des changements à commiter.
    echo Peut-être qu'il n'y a pas de changements ou que le commit précédent est identique.
) else (
    echo [OK] Commit créé avec succès
)

echo.

REM Pousser vers GitHub
echo [INFO] Envoi vers GitHub...
git push -u origin master 2>nul

if %errorlevel% neq 0 (
    echo [INFO] Tentative avec la branche main...
    git push -u origin main 2>nul

    if %errorlevel% neq 0 (
        echo [ERREUR] Impossible de pousser vers GitHub
        echo Vérifiez :
        echo 1. Que l'URL du repository est correcte
        echo 2. Que vous avez les droits d'écriture sur le repository
        echo 3. Que votre token d'accès GitHub est configuré si nécessaire
        echo.
        echo Commandes alternatives :
        echo git push -u origin main
        echo ou
        echo git push -u origin master
        echo.
        pause
        exit /b 1
    )
)

echo.
echo ========================================
echo         SUCCÈS ! 🎉
echo ========================================
echo.
echo Le projet Res-Sports a été poussé avec succès sur GitHub !
echo.
echo 📁 Repository : https://github.com/AmineGR03/res-sports
echo 📖 Guide d'installation : INSTALLATION_GUIDE.md
echo.
echo Prochaines étapes :
echo 1. Vérifiez le repository sur GitHub
echo 2. Partagez le guide d'installation avec votre équipe
echo 3. Les développeurs peuvent maintenant cloner et installer
echo.
pause