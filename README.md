**# Mini-CMS**

Projet fil rouge de l'Atelier Framework Côté Serveur (Laravel 13, PHP 8.3+), 3e année MDW, ISET Sidi Bouzid.

Auteur : Prenom Nom, groupe MDW32.

Mini-CMS évoluera au fil du semestre vers une petite plateforme de publication : pages publiques, back-office authentifié, API JSON et tests Pest. Chaque session se termine par un tag Git (\`lab-01\`, \`lab-01b\`, puis un tag par session).

## État actuel (tag lab-02b)

- Pages construites avec des composants Blade anonymes : `x-navbar`, `x-nav-link`, `x-post-card`, `x-alert`, `x-page-header`.
- Lien actif dans la navigation avec `request()->routeIs()`.
- Articles toujours stockés dans un tableau PHP, sans base de données pour l'instant.

- Routes en closures : `/`, `/bonjour`, `/bonjour-court`, `/bienvenue`, `/version`, `/heure` et `/a-propos`.
- Vues Blade : `bienvenue`, `heure` et `a-propos`.
- Base de données SQLite locale (`database/database.sqlite`, non versionnée).

\- PHP et Composer (PHP 8.3 ou plus depuis [https://www.php.net/downloads](https://www.php.net/downloads), avec les extensions curl, fileinfo, mbstring, openssl, pdo_sqlite, sqlite3 et zip activées dans php.ini, et Composer depuis [https://getcomposer.org](https://getcomposer.org)).
\- Node.js LTS et npm.
\- Git.

**## Installation**

**### Bash (Git Bash, macOS, Linux)**

\`\`\`bash
git clone [https://github.com/VOTRE-UTILISATEUR/mini-cms.git](https://github.com/VOTRE-UTILISATEUR/mini-cms.git)
cd mini-cms
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
composer run dev
\`\`\`

**### PowerShell (Windows)**

\`\`\`powershell
git clone [https://github.com/VOTRE-UTILISATEUR/mini-cms.git](https://github.com/VOTRE-UTILISATEUR/mini-cms.git)
cd mini-cms
composer install
npm install
copy .env.example .env
php artisan key:generate
New-Item database\database.sqlite -ItemType File
php artisan migrate
composer run dev
\`\`\`

Ouvrir ensuite [http://localhost:8000](http://localhost:8000) (adresse de l'application, différente de l'adresse de Vite sur le port 5173).

**## Captures d'écran**
### Accueil avec le layout

![Page d'accueil avec le layout](screenshots/s03-accueil.png)

### Liste des articles

![Liste des articles](screenshots/s03-articles.png)

### Détail d'un article

![Détail d'un article](screenshots/s03-article.png)

**### Page d'accueil**

![Page d'accueil de Mini-CMS]\(screenshots/s01-accueil.png)

**### Page Bienvenue**

![Page Bienvenue]\(screenshots/s01-bienvenue.png)

**### Liste des routes**

![Sortie de php artisan route:list]\(screenshots/s01-route-list.png)

**### Page À propos**

![Page A propos]\(screenshots/s02-a-propos.png)
### Session 04

![Liste des articles](screenshots/s04-articles.png)
## Routes disponibles

| Méthode | URI | Nom | Action |
|---|---|---|---|
| GET | `/` | `home` | `PageController@home` |
| GET | `/a-propos` | `about` | `PageController@about` |
| GET | `/heure` | `time` | `PageController@time` |
| GET | `/posts` | `posts.index` | `PostController@index` |
| GET | `/posts/archive/{year}` | `posts.archive` | `PostController@archive` |
| GET | `/posts/{slug}` | `posts.show` | `PostController@show` |