# 🏆 Res-Sports - Plateforme de Réservation Sportive

[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)](https://mysql.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-blue.svg)](https://tailwindcss.com)

**Res-Sports** est une plateforme web moderne de réservation de terrains sportifs et d'équipements. Développée avec Laravel et Tailwind CSS, elle offre une expérience utilisateur fluide pour la gestion des réservations sportives.

## 📋 Table des matières

- [🚀 Installation rapide](#-installation-rapide)
- [📖 Guide d'installation détaillé](#-guide-dinstallation-détaillé)
- [✨ Fonctionnalités](#-fonctionnalités)
- [🛠️ Technologies utilisées](#️-technologies-utilisées)
- [📋 Prérequis](#-prérequis)
- [🚀 Installation](#-installation)
- [⚙️ Configuration](#️-configuration)
- [🗄️ Base de données](#️-base-de-données)
- [🏃‍♂️ Lancement du projet](#️-lancement-du-projet)
- [📖 Utilisation](#-utilisation)
- [👥 Rôles et permissions](#-rôles-et-permissions)
- [📁 Structure du projet](#-structure-du-projet)
- [🔧 Scripts disponibles](#-scripts-disponibles)
- [🤝 Contribution](#-contribution)
- [📄 Licence](#-licence)

## 🚀 Installation rapide

> 📖 **Pour un guide d'installation détaillé avec captures d'écran, consultez [`INSTALLATION_GUIDE.md`](INSTALLATION_GUIDE.md)**

### Prérequis
- PHP 8.1+
- Composer
- Node.js & npm
- MySQL/MariaDB
- Git

### Étapes
```bash
# 1. Cloner le repository
git clone https://github.com/AmineGR03/res-sports.git
cd res-sports

# 2. Installer les dépendances
composer install
npm install

# 3. Configurer l'environnement
cp .env.example .env
# Éditez .env avec vos paramètres de base de données

# 4. Générer la clé d'application
php artisan key:generate

# 5. Migrer et peupler la base de données
php artisan migrate
php artisan db:seed

# 6. Compiler les assets
npm run build

# 7. Démarrer le serveur
php artisan serve
```

**Application accessible sur :** `http://localhost:8000`

### Comptes de test
- **Admin :** admin@res-sports.com / password
- **Clients :** elinor25@example.com / password (et autres)

---

## 📖 Guide d'installation détaillé

📋 **[Consultez le guide complet d'installation](INSTALLATION_GUIDE.md)** pour :
- Configuration détaillée de PHP et des extensions
- Paramétrage avancé de la base de données
- Déploiement en production
- Dépannage des problèmes courants
- Scripts de déploiement automatisés

## ✨ Fonctionnalités

### 👤 Utilisateur (Client)
- ✅ Inscription et connexion sécurisées
- ✅ Consultation des terrains disponibles
- ✅ Réservation de terrains avec sélection de créneaux horaires
- ✅ Ajout d'équipements à la réservation
- ✅ Historique des réservations
- ✅ Gestion du profil utilisateur (nom, email, téléphone, avatar)
- ✅ Annulation de réservations (conditions respectées)

### 👨‍💼 Administrateur
- ✅ Dashboard d'administration complet
- ✅ Gestion des utilisateurs (CRUD)
- ✅ Gestion des terrains (CRUD + images)
- ✅ Gestion des équipements (CRUD)
- ✅ Gestion des réservations (statuts, détails)
- ✅ Statistiques globales du système
- ✅ Interface d'administration séparée

### 🎨 Interface utilisateur
- ✅ Design moderne avec Tailwind CSS
- ✅ Interface responsive (mobile, tablette, desktop)
- ✅ Animations et transitions fluides
- ✅ Modal d'agrandissement des images
- ✅ Navigation intuitive avec rôles adaptés
- ✅ Messages d'erreur et de succès

## 🛠️ Technologies utilisées

- **Backend** : Laravel 10.x
- **Frontend** : Blade Templates + Tailwind CSS
- **Base de données** : MySQL 8.0+
- **Serveur web** : Apache/Nginx
- **PHP** : 8.1 ou supérieur
- **JavaScript** : Vanilla JS (ES6+)
- **Versioning** : Git

## 📋 Prérequis

Avant d'installer le projet, assurez-vous d'avoir :

### Système d'exploitation
- ✅ Windows 10/11, macOS, ou Linux
- ✅ Minimum 4GB RAM
- ✅ 2GB espace disque libre

### Logiciels requis
- ✅ **PHP 8.1 ou supérieur** avec extensions :
  - `pdo`
  - `pdo_mysql`
  - `mbstring`
  - `openssl`
  - `tokenizer`
  - `xml`
  - `ctype`
  - `json`
  - `bcmath`
  - `fileinfo`

- ✅ **Composer** (dernnière version)
- ✅ **MySQL 8.0+** ou **MariaDB**
- ✅ **Node.js 16+** et **npm** (pour les assets)
- ✅ **Git** (pour le versioning)

### Outils recommandés
- ✅ **Visual Studio Code** ou IDE PHP
- ✅ **MySQL Workbench** ou phpMyAdmin
- ✅ **Postman** (pour tester l'API)
- ✅ **Browser DevTools** (Chrome/Firefox)

## 🚀 Installation

### Étape 1 : Cloner le repository

```bash
git clone https://github.com/votre-username/res-sports.git
cd res-sports
```

### Étape 2 : Installer les dépendances PHP

```bash
composer install
```

### Étape 3 : Installer les dépendances Node.js

```bash
npm install
npm run build
# ou pour le développement :
npm run dev
```

### Étape 4 : Créer le fichier d'environnement

```bash
cp .env.example .env
```

## ⚙️ Configuration

### Étape 1 : Configuration de l'environnement

Ouvrez le fichier `.env` et modifiez les paramètres suivants :

```env
APP_NAME="Res-Sports"
APP_ENV=local
APP_KEY=  # Sera généré automatiquement
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de données
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=res_sports
DB_USERNAME=votre_username_mysql
DB_PASSWORD=votre_password_mysql

# Cache et sessions
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
```

### Étape 2 : Générer la clé d'application

```bash
php artisan key:generate
```

### Étape 3 : Créer le lien symbolique pour le stockage

```bash
php artisan storage:link
```

## 🗄️ Base de données

### Étape 1 : Créer la base de données

Dans MySQL Workbench ou phpMyAdmin :

```sql
CREATE DATABASE res_sports CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Étape 2 : Exécuter les migrations

```bash
php artisan migrate
```

### Étape 3 : Peupler la base de données

```bash
php artisan db:seed
```

Cette commande va créer :
- ✅ 1 administrateur (`admin@res-sports.com` / `password`)
- ✅ 6 utilisateurs de test
- ✅ 1 terrain de football (Barcelone FC)
- ✅ Équipements sportifs variés
- ✅ Quelques réservations d'exemple

## 🏃‍♂️ Lancement du projet

### Démarrage du serveur de développement

```bash
php artisan serve
```

Le projet sera accessible sur : **http://127.0.0.1:8000**

### Compilation des assets (optionnel pour le développement)

```bash
# Pour le développement (avec hot reload)
npm run dev

# Pour la production
npm run build
```

## 📖 Utilisation

### 🔐 Comptes de test

#### Administrateur
- **Email** : `admin@res-sports.com`
- **Mot de passe** : `password`
- **Accès** : Dashboard admin complet

#### Utilisateur de test
Consultez la table `users` dans votre base de données pour les autres comptes de test.

### 🎯 Workflow utilisateur

1. **Inscription/Connexion** : Créer un compte ou se connecter
2. **Explorer les terrains** : Voir tous les terrains disponibles
3. **Réserver un terrain** :
   - Sélectionner un terrain
   - Choisir une date
   - Sélectionner un créneau horaire
   - Ajouter des équipements (optionnel)
   - Confirmer la réservation
4. **Gérer les réservations** : Voir l'historique, annuler si possible
5. **Modifier le profil** : Nom, email, téléphone, avatar

### 👨‍💼 Interface administrateur

1. **Dashboard** : Statistiques globales et réservations récentes
2. **Utilisateurs** : Gérer tous les comptes utilisateur
3. **Terrains** : CRUD complet des terrains sportifs
4. **Équipements** : Gestion du stock et des équipements
5. **Réservations** : Supervision de toutes les réservations

## 👥 Rôles et permissions

### 👤 Client (Utilisateur normal)
- ✅ Consultation des terrains et équipements
- ✅ Réservation de terrains (avec créneaux)
- ✅ Gestion de ses propres réservations
- ✅ Modification de son profil
- ❌ Accès à l'administration

### 👨‍💼 Admin (Administrateur)
- ✅ Toutes les permissions client
- ✅ Accès au panneau d'administration
- ✅ Gestion complète des utilisateurs
- ✅ Gestion complète des terrains
- ✅ Gestion complète des équipements
- ✅ Gestion complète des réservations
- ✅ Accès aux statistiques globales

## 📁 Structure du projet

```
res-sports/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php      # Gestion admin
│   │   │   ├── AuthController.php       # Authentification
│   │   │   ├── DashboardController.php  # Dashboard utilisateur
│   │   │   ├── ProfileController.php    # Profil utilisateur
│   │   │   ├── ReservationController.php # Réservations
│   │   │   └── TerrainController.php    # Terrains
│   │   ├── Middleware/
│   │   │   ├── ClientMiddleware.php     # Restriction clients
│   │   │   └── RoleMiddleware.php       # Gestion des rôles
│   │   └── Policies/
│   │       └── ReservationPolicy.php    # Politiques réservations
│   ├── Models/
│   │   ├── User.php                     # Modèle utilisateur
│   │   ├── Terrain.php                  # Modèle terrain
│   │   ├── Equipement.php              # Modèle équipement
│   │   └── Reservation.php             # Modèle réservation
│   └── Providers/
│       └── AuthServiceProvider.php      # Services d'authentification
├── database/
│   ├── migrations/                      # Migrations base de données
│   ├── seeders/                         # Seeders pour données de test
│   └── factories/                       # Factories pour tests
├── public/
│   ├── storage/                         # Fichiers uploadés (liés)
│   └── images/                          # Images statiques
├── resources/
│   ├── views/                           # Templates Blade
│   │   ├── layouts/                     # Layouts principaux
│   │   ├── admin/                       # Vues administration
│   │   ├── auth/                        # Vues authentification
│   │   └── terrains/                    # Vues terrains
│   └── css/                             # Styles CSS
├── routes/
│   ├── web.php                          # Routes web
│   └── api.php                          # Routes API (si utilisées)
├── storage/
│   ├── app/                             # Stockage fichiers
│   ├── logs/                            # Logs application
│   └── framework/                       # Cache Laravel
├── tests/                                # Tests unitaires/intégration
├── .env.example                         # Exemple configuration
├── artisan                              # Console Laravel
├── composer.json                        # Dépendances PHP
├── package.json                         # Dépendances Node.js
└── README.md                            # Ce fichier
```

## 🔧 Scripts disponibles

### Artisan Commands

```bash
# Base de données
php artisan migrate                    # Exécuter les migrations
php artisan migrate:fresh              # Reset complet DB
php artisan db:seed                    # Peupler la DB
php artisan migrate:fresh --seed       # Reset + seed

# Cache et optimisation
php artisan config:cache               # Cacher la config
php artisan route:cache                # Cacher les routes
php artisan view:cache                 # Cacher les vues
php artisan cache:clear                # Vider le cache

# Stockage
php artisan storage:link               # Créer lien storage

# Développement
php artisan serve                      # Serveur développement
php artisan tinker                     # Console interactive
```

### NPM Scripts

```bash
npm run dev         # Compilation développement (watch)
npm run build       # Compilation production
npm run prod        # Compilation production optimisée
```

## 🔍 Dépannage

### Erreur "Class not found"
```bash
composer dump-autoload
```

### Erreur base de données
```bash
php artisan config:clear
php artisan cache:clear
```

### Erreur permissions fichiers
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

### Erreur "Route not found"
```bash
php artisan route:clear
php artisan route:cache
```

## 🤝 Contribution

1. Fork le projet
2. Créer une branche feature (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

### Standards de code
- ✅ PSR-12 pour PHP
- ✅ ESLint pour JavaScript
- ✅ Tests unitaires pour les nouvelles fonctionnalités
- ✅ Documentation des nouvelles méthodes

## 📄 Licence

Ce projet est sous licence MIT - voir le fichier [LICENSE](LICENSE) pour plus de détails.

## 🙏 Remerciements

- [Laravel](https://laravel.com/) - Framework PHP
- [Tailwind CSS](https://tailwindcss.com/) - Framework CSS
- [Alpine.js](https://alpinejs.dev/) - Framework JavaScript léger
- [Heroicons](https://heroicons.com/) - Icônes SVG

---

## 📞 Support

Pour toute question ou problème :
1. Vérifiez la section [Dépannage](#dépannage)
2. Consultez les [Issues GitHub](https://github.com/votre-username/res-sports/issues)
3. Créez une nouvelle issue si nécessaire

---

**🚀 Profitez de votre plateforme Res-Sports !**