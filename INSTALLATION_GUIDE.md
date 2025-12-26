# Guide d'Installation - Res-Sports

## 📋 Prérequis Système

Avant de commencer, assurez-vous d'avoir installé :

### Logiciels Requis
- **PHP 8.1 ou supérieur** avec extensions nécessaires
- **Composer** (gestionnaire de dépendances PHP)
- **Node.js** et **npm** (pour les assets frontend)
- **MySQL** ou **MariaDB** (base de données)
- **Git** (pour cloner le repository)

### Vérification des Versions
```bash
php --version          # Doit être >= 8.1
composer --version     # Dernière version stable
node --version         # Dernière version LTS
npm --version          # Dernière version
mysql --version        # Doit être disponible
git --version          # Dernière version
```

---

## 🚀 Installation Étape par Étape

### Étape 1 : Cloner le Repository

```bash
# Cloner le repository depuis GitHub
git clone https://github.com/AmineGR03/res-sports.git

# Se déplacer dans le dossier du projet
cd res-sports
```

### Étape 2 : Configuration PHP

#### Modifications dans `php.ini`

Localisez votre fichier `php.ini` (généralement dans `/php/php.ini` ou `/etc/php/8.1/apache2/php.ini`) et assurez-vous que ces extensions sont activées :

```ini
extension=pdo_mysql
extension=mbstring
extension=openssl
extension=tokenizer
extension=xml
extension=ctype
extension=json
extension=bcmath
extension=fileinfo
extension=gd
extension=curl
extension=zip
```

#### Augmenter les Limites PHP (recommandé pour le développement)

```ini
memory_limit = 256M
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
```

### Étape 3 : Installation des Dépendances

```bash
# Installer les dépendances PHP avec Composer
composer install

# Installer les dépendances Node.js
npm install
```

### Étape 4 : Configuration de l'Environnement

#### Copier le fichier d'environnement
```bash
cp .env.example .env
```

#### Éditer le fichier `.env`
Ouvrez `.env` et configurez les paramètres suivants :

```env
APP_NAME="Res-Sports"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de données
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=res_sports
DB_USERNAME=votre_username_mysql
DB_PASSWORD=votre_password_mysql

# Mail (optionnel pour développement)
MAIL_MAILER=log
```

### Étape 5 : Configuration de la Base de Données

#### Créer la base de données
```sql
-- Dans MySQL, créez la base de données
CREATE DATABASE res_sports CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Générer la clé d'application
```bash
php artisan key:generate
```

#### Exécuter les migrations
```bash
# Créer les tables de la base de données
php artisan migrate

# Peupler la base avec des données de test
php artisan db:seed
```

### Étape 6 : Compiler les Assets

```bash
# Compiler les assets pour la production
npm run build

# OU pour le développement avec surveillance des changements
npm run dev
```

### Étape 7 : Démarrer le Serveur

```bash
# Démarrer le serveur de développement Laravel
php artisan serve
```

L'application sera accessible sur : `http://localhost:8000`

---

## 🔐 Comptes de Test

Après l'exécution des seeders, ces comptes sont disponibles :

### Administrateur
- **Email** : admin@res-sports.com
- **Mot de passe** : password
- **Rôle** : Administrateur

### Clients de Test
- **Email** : elinor25@example.com, adeline25@example.com, oconner.brennan@example.org, emory53@example.net, roosevelt.yundt@example.net, howe.katharina@example.org
- **Mot de passe** : password (pour tous)
- **Rôle** : Client

---

## 📁 Structure du Projet

```
res-sports/
├── app/                    # Code de l'application Laravel
│   ├── Http/Controllers/   # Contrôleurs
│   ├── Models/            # Modèles Eloquent
│   └── Policies/          # Politiques d'autorisation
├── database/              # Migrations et seeders
│   ├── migrations/        # Schéma de base de données
│   └── seeders/           # Données de test
├── public/                # Assets publics (images, CSS, JS)
├── resources/             # Vues et assets bruts
│   ├── views/            # Templates Blade
│   └── css/              # Styles personnalisés
├── routes/                # Définition des routes
│   ├── web.php           # Routes web
│   └── api.php           # Routes API
├── storage/               # Fichiers temporaires et logs
├── tests/                 # Tests automatisés
├── .env.example          # Template de configuration
├── composer.json         # Dépendances PHP
├── package.json          # Dépendances Node.js
└── vite.config.js        # Configuration Vite
```

---

## 🛠️ Commandes Utiles pour le Développement

### Gestion de la Base de Données
```bash
# Réinitialiser et repeupler la base
php artisan migrate:fresh --seed

# Créer une nouvelle migration
php artisan make:migration nom_de_la_migration

# Créer un nouveau seeder
php artisan make:seeder NomDuSeeder
```

### Gestion des Assets
```bash
# Compiler pour la production
npm run build

# Développement avec rechargement automatique
npm run dev

# Surveillance des changements
npm run watch
```

### Cache et Optimisation
```bash
# Vider tous les caches
php artisan optimize:clear

# Générer les caches pour la production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Tests
```bash
# Exécuter tous les tests
php artisan test

# Exécuter un test spécifique
php artisan test --filter=NomDuTest
```

---

## 🔧 Dépannage

### Erreur "Class not found"
```bash
# Régénérer l'autoloader
composer dump-autoload
```

### Erreur de Base de Données
```bash
# Vérifier la connexion
php artisan tinker
DB::connection()->getPdo();
```

### Erreur de Permissions
```bash
# Corriger les permissions sur Linux/Mac
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Erreur d'Assets
```bash
# Nettoyer et recompiler
npm run clean
npm install
npm run build
```

---

## 📚 Fonctionnalités de l'Application

### Pour les Administrateurs
- ✅ Gestion complète des utilisateurs
- ✅ Gestion des terrains sportifs
- ✅ Gestion des équipements
- ✅ Supervision des réservations
- ✅ Statistiques et métriques

### Pour les Clients
- ✅ Consultation des terrains disponibles
- ✅ Réservation avec calcul automatique du prix
- ✅ Gestion des équipements supplémentaires
- ✅ Suivi des réservations personnelles

### Fonctionnalités Techniques
- ✅ Authentification sécurisée
- ✅ Autorisations par rôles
- ✅ Validation des données
- ✅ Upload d'images
- ✅ Interface responsive
- ✅ API RESTful

---

## 🚀 Déploiement en Production

### Préparation pour la Production
```bash
# Variables d'environnement
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votredomaine.com

# Optimisations
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Compiler les assets
npm run build
```

### Serveur Web (Apache/Nginx)
Assurez-vous que le document root pointe vers le dossier `public/` du projet.

### SSL et Sécurité
- Activez HTTPS avec un certificat SSL
- Configurez les headers de sécurité
- Utilisez des variables d'environnement pour les clés sensibles

---

## 📞 Support

Si vous rencontrez des problèmes lors de l'installation :

1. Vérifiez que tous les prérequis sont installés
2. Consultez les logs Laravel dans `storage/logs/`
3. Vérifiez les permissions des fichiers
4. Assurez-vous que la base de données est accessible

Pour plus d'aide, consultez la documentation Laravel officielle ou créez une issue sur le repository GitHub.

---

## 📝 Notes Importantes

- **Version PHP** : Minimum 8.1 requis
- **Base de données** : MySQL/MariaDB recommandé
- **Navigateur** : Dernières versions de Chrome, Firefox, Safari, Edge
- **Stockage** : Assurez-vous que le dossier `storage/` est accessible en écriture

---

*Dernière mise à jour : Décembre 2025*
*Version : 1.0.0*
