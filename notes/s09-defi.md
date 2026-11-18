# Session 09 - Défi

Le bandeau s'affiche sur toutes les pages quand SITE_READ_ONLY=true : oui
Le bandeau disparaît quand SITE_READ_ONLY=false : oui
La page Article introuvable propose au plus trois articles publiés, sans brouillon : oui
Aucune LazyLoadingViolationException sur /posts/999 : oui
Les deux nouveaux tests passent et php artisan test est vert : oui

Pourquoi le bandeau est-il dans le layout et pas dans chaque vue ?
> Parce que le layout (`x-layout`) est le seul fichier commun à toutes les pages. Une information qui concerne tout le site (bandeau d'état, message flash) n'a besoin d'être écrite qu'une seule fois dans le layout pour apparaître partout, au lieu de la dupliquer dans chaque vue.

Pourquoi le test du bandeau n'a-t-il pas besoin de modifier .env ?
> Parce que `Config::set('site.read_only', true)` modifie la valeur en mémoire pour la durée du test uniquement, sans toucher au fichier `.env`. C'est plus rapide, isolé, et ne risque pas de laisser des effets de bord entre les tests.
