# Script PowerShell pour pousser Res-Sports vers GitHub

Write-Host "🚀 Configuration du repository GitHub pour Res-Sports" -ForegroundColor Green

# Supprimer les fichiers inutiles
Write-Host "🧹 Suppression des fichiers temporaires..." -ForegroundColor Yellow
Get-ChildItem -Path "." -Recurse -Include "*.log","*.tmp","*test*","*debug*","*check*","git_commands.bat","setup_github.ps1" -File -ErrorAction SilentlyContinue | Remove-Item -Force -ErrorAction SilentlyContinue

# Vérifier si git est installé
try {
    $gitVersion = git --version 2>$null
    Write-Host "✅ Git détecté: $gitVersion" -ForegroundColor Green
}
catch {
    Write-Host "❌ Git n'est pas installé. Veuillez installer Git depuis https://git-scm.com/" -ForegroundColor Red
    exit 1
}

# Initialiser le repository si nécessaire
if (!(Test-Path ".git")) {
    Write-Host "📁 Initialisation du repository Git..." -ForegroundColor Yellow
    git init
    Write-Host "✅ Repository Git initialisé" -ForegroundColor Green
}
else {
    Write-Host "✅ Repository Git déjà initialisé" -ForegroundColor Green
}

# Configurer le remote
Write-Host "🔗 Configuration du remote GitHub..." -ForegroundColor Yellow
git remote remove origin 2>$null
git remote add origin https://github.com/AmineGR03/res-sports.git
Write-Host "✅ Remote configuré: https://github.com/AmineGR03/res-sports.git" -ForegroundColor Green

# Ajouter tous les fichiers
Write-Host "📦 Ajout des fichiers..." -ForegroundColor Yellow
git add .
Write-Host "✅ Fichiers ajoutés" -ForegroundColor Green

# Créer le commit
Write-Host "💾 Création du commit..." -ForegroundColor Yellow
$commitMessage = @"
Initial commit: Res-Sports - Plateforme de réservation sportive

🚀 Fonctionnalités implémentées:
✅ Authentification complète (clients/admins)
✅ Gestion des terrains sportifs avec images
✅ Système de réservation avec créneaux horaires
✅ Gestion des équipements sportifs
✅ Interface d'administration complète
✅ Design moderne avec Tailwind CSS
✅ Modal d'agrandissement des images
✅ Gestion des profils utilisateurs

🛠️ Technologies:
- Laravel 10.x
- MySQL 8.0+
- Tailwind CSS 3.x
- JavaScript ES6+

📚 Documentation complète dans README.md
"@

git commit -m $commitMessage
Write-Host "✅ Commit créé" -ForegroundColor Green

# Pousser vers GitHub
Write-Host "⬆️ Push vers GitHub..." -ForegroundColor Yellow
git branch -M main
$pushResult = git push -u origin main 2>&1

if ($LASTEXITCODE -eq 0) {
    Write-Host "🎉 Succès ! Le projet a été poussé vers GitHub !" -ForegroundColor Green
    Write-Host "🔗 Repository: https://github.com/AmineGR03/res-sports" -ForegroundColor Cyan
}
else {
    Write-Host "❌ Erreur lors du push:" -ForegroundColor Red
    Write-Host $pushResult -ForegroundColor Yellow
    Write-Host "💡 Conseil: Utilisez un Personal Access Token comme mot de passe" -ForegroundColor Yellow
    Write-Host "   1. Allez sur https://github.com/settings/tokens" -ForegroundColor White
    Write-Host "   2. Créez un token avec permissions 'repo'" -ForegroundColor White
    Write-Host "   3. Utilisez ce token comme mot de passe git" -ForegroundColor White
}

Write-Host "`n📋 Prochaines étapes:" -ForegroundColor Cyan
Write-Host "1. Vérifiez le repository sur GitHub" -ForegroundColor White
Write-Host "2. Lisez le README.md pour les instructions d'installation" -ForegroundColor White
Write-Host "3. Partagez votre projet avec la communauté !" -ForegroundColor White
