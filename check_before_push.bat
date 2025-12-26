@echo off
echo ========================================
echo   VÉRIFICATION AVANT PUSH GITHUB
echo ========================================
echo.

REM Vérifier si les fichiers critiques existent
echo [VERIFICATION] Fichiers critiques...

if exist "composer.json" (
    echo ✅ composer.json trouvé
) else (
    echo ❌ composer.json manquant
    goto :error
)

if exist "package.json" (
    echo ✅ package.json trouvé
) else (
    echo ❌ package.json manquant
    goto :error
)

if exist "INSTALLATION_GUIDE.md" (
    echo ✅ Guide d'installation trouvé
) else (
    echo ❌ Guide d'installation manquant
    goto :error
)

if exist "README.md" (
    echo ✅ README.md trouvé
) else (
    echo ❌ README.md manquant
    goto :error
)

echo.

REM Vérifier les dossiers importants
echo [VERIFICATION] Structure des dossiers...

if exist "app" (
    echo ✅ Dossier app trouvé
) else (
    echo ❌ Dossier app manquant
    goto :error
)

if exist "resources" (
    echo ✅ Dossier resources trouvé
) else (
    echo ❌ Dossier resources manquant
    goto :error
)

if exist "routes" (
    echo ✅ Dossier routes trouvé
) else (
    echo ❌ Dossier routes manquant
    goto :error
)

if exist "database" (
    echo ✅ Dossier database trouvé
) else (
    echo ❌ Dossier database manquant
    goto :error
)

echo.

REM Vérifier les vues admin
echo [VERIFICATION] Vues d'administration...

if exist "resources\views\admin" (
    echo ✅ Dossier admin trouvé
) else (
    echo ❌ Dossier admin manquant
    goto :error
)

REM Compter les fichiers admin
for /f %%c in ('dir /b resources\views\admin\* 2^>nul ^| find /c ".blade.php"') do set ADMIN_FILES=%%c
if %ADMIN_FILES% gtr 0 (
    echo ✅ %ADMIN_FILES% vues admin trouvées
) else (
    echo ❌ Aucune vue admin trouvée
    goto :error
)

echo.

REM Vérifier .env.example
echo [VERIFICATION] Configuration...

if exist ".env.example" (
    echo ✅ Template .env trouvé
) else (
    echo ❌ Template .env manquant
    goto :error
)

if exist "php artisan" (
    echo ✅ Artisan disponible
) else (
    echo ❌ Artisan non disponible
)

echo.

REM Vérifier si les routes fonctionnent
echo [VERIFICATION] Routes Laravel...

php artisan route:list --compact >nul 2>&1
if %errorlevel% equ 0 (
    for /f %%c in ('php artisan route:list --compact ^| find /c "GET\|HEAD\|POST\|PUT\|DELETE"') do set ROUTE_COUNT=%%c
    echo ✅ %ROUTE_COUNT% routes configurées
) else (
    echo ❌ Erreur avec les routes Laravel
    goto :error
)

echo.

echo ========================================
echo         TOUT EST PRÊT ! 🎉
echo ========================================
echo.
echo ✅ Structure du projet complète
echo ✅ Guide d'installation créé
echo ✅ Vues d'administration présentes
echo ✅ Routes configurées
echo ✅ Fichiers de configuration présents
echo.
echo Vous pouvez maintenant exécuter :
echo   push_to_github.bat    (Windows)
echo   ou
echo   .\push_to_github.ps1  (PowerShell)
echo.
pause
goto :end

:error
echo.
echo ========================================
echo        ERREUR DETECTÉE ❌
echo ========================================
echo.
echo Corrigez les problèmes ci-dessus avant de pousser sur GitHub.
echo.
pause
exit /b 1

:end
