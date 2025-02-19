# 📌 Laravel SEO Schema API

## 🚀 Introduction
Ce projet est une API Laravel permettant de générer des données **JSON-LD** pour **Schema.org**. Il supporte les types suivants :

- **Person**
- **Organization**
- **Event**
- **Product**
- **Offer**

L'API fonctionne avec un **frontend dynamique** qui génère un formulaire en fonction du type sélectionné.

## ⚙️ Prérequis
Ce projet utilise **Laravel 11** et est exécuté avec **Herd** (serveur local optimisé pour Laravel). Assurez-vous d'avoir :

- [PHP 8.1+](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/download/)
- [Herd](https://herd.laravel.com/)
- **MySQL** ou SQLite pour la base de données

## 📥 Installation

### 1️⃣ Cloner le projet
```sh
git clone https://github.com/votre-repo/seo-schema.git
cd seo-schema
```

### 2️⃣ Installer les dépendances
```sh
composer install
```

### 3️⃣ Configuration de l’environnement
Copiez le fichier `.env.example` et renommez-le `.env` :
```sh
cp .env.example .env
```

Modifiez les paramètres de base de données dans `.env` si nécessaire :
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seo_schema
DB_USERNAME=root
DB_PASSWORD=
```

Puis générez la clé d'application :
```sh
php artisan key:generate
```

### 4️⃣ Lancer les migrations
```sh
php artisan migrate
```

### 5️⃣ Démarrer le serveur Herd
Si vous utilisez **Herd**, pas besoin de lancer un serveur Laravel. Vérifiez que votre projet est bien listé dans Herd et accessible via :
```
http://seo-schema.test
```

Sinon, vous pouvez lancer Laravel manuellement :
```sh
php artisan serve
```

## 🔥 Utilisation de l’API
### Endpoints disponibles
#### 1️⃣ Récupérer les propriétés d’un type
```http
GET /api/{type}/properties
```
Exemple pour un **Événement** :
```sh
GET http://seo-schema.test/api/event/properties
```

#### 2️⃣ Générer le JSON-LD d’un type
```http
POST /api/{type}/generate-json-ld
```
Exemple pour un **Événement** :
```sh
POST http://seo-schema.test/api/event/generate-json-ld
```
Avec un JSON dans le corps de la requête :
```json
{
  "properties": {
    "name": "Conférence Tech",
    "startDate": "2025-06-12",
    "endDate": "2025-06-14",
    "location": {
      "name": "Paris Expo",
      "address": "1 rue de la conférence, Paris"
    },
    "description": "Un événement technologique majeur",
    "organizer": {
      "@type": "Organization",
      "name": "TechCorp"
    }
  }
}
```

### 🛠️ Debugging & Erreurs
- Vérifiez que les migrations sont bien appliquées :
  ```sh
  php artisan migrate:status
  ```
- Vérifiez que les routes sont bien définies :
  ```sh
  php artisan route:list
  ```
- En cas d’erreur **500**, activez le mode debug dans **.env** :
  ```ini
  APP_DEBUG=true
  ```
- Vérifiez que Herd fonctionne bien et que votre projet est bien listé.

## 📜 Licence
Ce projet est sous licence MIT. Vous êtes libre de l’utiliser et de le modifier selon vos besoins.

---
🎉 **Bon développement !** 🚀