# Script PowerShell pour pousser Res-Sports sur GitHub
# Utilisation : .\push_to_github.ps1

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "   PUSH RES-SPORTS TO GITHUB" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Vérifier si Git est installé
try {
    $gitVersion = git --version 2>$null
    Write-Host "[OK] Git est installé" -ForegroundColor Green
} catch {
    Write-Host "[ERREUR] Git n'est pas installé ou n'est pas dans le PATH" -ForegroundColor Red
    Write-Host "Veuillez installer Git depuis https://git-scm.com/" -ForegroundColor Yellow
    Read-Host "Appuyez sur Entrée pour quitter"
    exit 1
}

Write-Host ""

# Vérifier si c'est un repository Git
if (-not (Test-Path ".git")) {
    Write-Host "[INFO] Initialisation du repository Git..." -ForegroundColor Yellow
    git init
    Write-Host "[OK] Repository Git initialisé" -ForegroundColor Green
} else {
    Write-Host "[OK] Repository Git déjà initialisé" -ForegroundColor Green
}

Write-Host ""

# Vérifier la configuration Git
$gitUser = git config --global user.name
$gitEmail = git config --global user.email

if ([string]::IsNullOrEmpty($gitUser)) {
    Write-Host "[ATTENTION] Nom d'utilisateur Git non configuré" -ForegroundColor Yellow
    Write-Host "Configurez votre nom : git config --global user.name 'Votre Nom'" -ForegroundColor Cyan
}

if ([string]::IsNullOrEmpty($gitEmail)) {
    Write-Host "[ATTENTION] Email Git non configuré" -ForegroundColor Yellow
    Write-Host "Configurez votre email : git config --global user.email 'votre.email@example.com'" -ForegroundColor Cyan
}

if ([string]::IsNullOrEmpty($gitUser) -or [string]::IsNullOrEmpty($gitEmail)) {
    Write-Host ""
    Write-Host "Veuillez configurer Git avant de continuer." -ForegroundColor Red
    Read-Host "Appuyez sur Entrée pour quitter"
    exit 1
}

Write-Host "[OK] Configuration Git trouvée - $gitUser <$gitEmail>" -ForegroundColor Green
Write-Host ""

# Ajouter le repository distant
Write-Host "[INFO] Configuration du repository distant..." -ForegroundColor Yellow
git remote remove origin 2>$null
git remote add origin https://github.com/AmineGR03/res-sports.git
Write-Host "[OK] Repository distant configuré" -ForegroundColor Green
Write-Host ""

# Créer un fichier .gitignore s'il n'existe pas
if (-not (Test-Path ".gitignore")) {
    Write-Host "[INFO] Création du fichier .gitignore..." -ForegroundColor Yellow
    @"
# Laravel
/vendor/
/node_modules/
.env
.env.local
storage/app/*
storage/framework/cache/*
storage/framework/sessions/*
storage/framework/views/*
storage/logs/*
bootstrap/cache/*
"@ | Out-File -FilePath .gitignore -Encoding UTF8
    Write-Host "[OK] Fichier .gitignore créé" -ForegroundColor Green
} else {
    Write-Host "[OK] Fichier .gitignore déjà présent" -ForegroundColor Green
}

Write-Host ""

# Ajouter tous les fichiers
Write-Host "[INFO] Ajout des fichiers au repository..." -ForegroundColor Yellow
git add .
Write-Host "[OK] Fichiers ajoutés" -ForegroundColor Green
Write-Host ""

# Créer le commit initial
Write-Host "[INFO] Création du commit initial..." -ForegroundColor Yellow

$commitMessage = @"
Initial commit - Res-Sports application

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

📋 Pour l'installation, consultez INSTALLATION_GUIDE.md
"@

git commit -m $commitMessage

if ($LASTEXITCODE -ne 0) {
    Write-Host "[ATTENTION] Le commit a échoué. Vérifiez s'il y a des changements à commiter." -ForegroundColor Yellow
    Write-Host "Peut-être qu'il n'y a pas de changements ou que le commit précédent est identique." -ForegroundColor Yellow
} else {
    Write-Host "[OK] Commit créé avec succès" -ForegroundColor Green
}

Write-Host ""

# Pousser vers GitHub
Write-Host "[INFO] Envoi vers GitHub..." -ForegroundColor Yellow

# Essayer d'abord avec master
git push -u origin master 2>$null

if ($LASTEXITCODE -ne 0) {
    Write-Host "[INFO] Tentative avec la branche main..." -ForegroundColor Yellow
    git push -u origin main 2>$null

    if ($LASTEXITCODE -ne 0) {
        Write-Host "[ERREUR] Impossible de pousser vers GitHub" -ForegroundColor Red
        Write-Host "Vérifiez :" -ForegroundColor Yellow
        Write-Host "1. Que l'URL du repository est correcte" -ForegroundColor White
        Write-Host "2. Que vous avez les droits d'écriture sur le repository" -ForegroundColor White
        Write-Host "3. Que votre token d'accès GitHub est configuré si nécessaire" -ForegroundColor White
        Write-Host ""
        Write-Host "Commandes alternatives :" -ForegroundColor Cyan
        Write-Host "git push -u origin main" -ForegroundColor White
        Write-Host "ou" -ForegroundColor White
        Write-Host "git push -u origin master" -ForegroundColor White
        Write-Host ""
        Read-Host "Appuyez sur Entrée pour quitter"
        exit 1
    }
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "         SUCCÈS ! 🎉" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""
Write-Host "Le projet Res-Sports a été poussé avec succès sur GitHub !" -ForegroundColor Cyan
Write-Host ""
Write-Host "📁 Repository : https://github.com/AmineGR03/res-sports" -ForegroundColor White
Write-Host "📖 Guide d'installation : INSTALLATION_GUIDE.md" -ForegroundColor White
Write-Host ""
Write-Host "Prochaines étapes :" -ForegroundColor Yellow
Write-Host "1. Vérifiez le repository sur GitHub" -ForegroundColor White
Write-Host "2. Partagez le guide d'installation avec votre équipe" -ForegroundColor White
Write-Host "3. Les développeurs peuvent maintenant cloner et installer" -ForegroundColor White
Write-Host ""
Read-Host "Appuyez sur Entrée pour terminer"
