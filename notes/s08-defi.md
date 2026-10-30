# Session 08 - Défi

La route posts.tag utilise {tag:slug} : oui
La page d'un tag n'affiche ni brouillon ni article d'un autre tag : oui
Les tags des cartes sont des liens : oui
L'accueil n'affiche que les tags qui ont au moins un article publié : oui
Les trois nouveaux tests passent et php artisan test est vert : oui

Pourquoi filtrer les tags vides après get() plutôt que d'afficher (0) ?
Parce que l'énoncé demande de ne pas afficher un tag qui n'a aucun article publié,
pas même avec un compteur à zéro. Filtrer après get() permet d'utiliser withCount()
en une seule requête SQL (pas N+1), puis d'exclure en PHP les tags dont posts_count
vaut 0. Si on filtrait en SQL (HAVING posts_count > 0), le résultat serait identique,
mais le filtre after get() est plus explicite et cohérent avec le reste du code Laravel.

Combien de requêtes ajoute la liste des tags populaires, et pourquoi pas une par tag ?
Une seule requête supplémentaire. Tag::withCount(['posts' => fn($q) => $q->published()])
génère un seul SELECT avec une sous-requête COUNT() filtrée par is_published = 1.
Sans withCount(), il faudrait charger tous les tags puis appeler $tag->posts()->count()
pour chacun, ce qui produirait N requêtes (une par tag) — le problème N+1.
withCount() résout tout en une seule requête SQL.

## Bonus PostgreSQL

Pourquoi aucune migration, aucun modèle et aucun test n'a changé ?
Parce que Laravel est conçu pour être indépendant du moteur de base de données.
Les migrations utilisent le Schema Builder de Laravel qui génère le SQL adapté
au driver configuré (SQLite, PostgreSQL, MySQL...).
Les modèles Eloquent font de même : les requêtes sont construites via le Query Builder
qui traduit en SQL compatible avec le driver actif.
Les tests restent sur SQLite en mémoire (phpunit.xml) car ils sont rapides et isolés ;
changer le driver de l'app n'affecte pas la configuration de test.
Résultat : zéro ligne de code modifiée pour passer de SQLite à PostgreSQL.
