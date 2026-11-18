# Session 10 - Robustesse

TagAdminTest contient 5 tests verts : oui
/posts/categorie/inconnue affiche Catégorie introuvable avec le statut 404 : oui
php artisan test est vert : oui

1. Pourquoi le message de messages() l'emporte-t-il sur celui de lang/fr/validation.php ?
> Parce que Laravel donne la priorité aux messages définis dans la méthode messages() du Form Request. C'est le niveau le plus spécifique : il l'emporte sur le fichier de langue global (lang/fr/validation.php), qui sert de valeur par défaut.

2. Pourquoi phpunit.xml fixe-t-il APP_LOCALE ?
> Pour que les tests donnent le même résultat sur chaque poste et sur un clone propre, quelle que soit la locale du .env personnel. Sans cette ligne, un test qui compare un message français échouerait sur un poste dont le .env est en anglais.

3. Pourquoi CategoryController n'a-t-il besoin d'aucun try/catch ?
> Parce que Laravel gère les erreurs automatiquement : la validation est déléguée aux Form Requests (qui redirigent avec les erreurs), le model binding lève une ModelNotFoundException gérée par le handler d'exceptions, et les opérations CRUD standard n'ont pas besoin de gestion d'erreur manuelle.
