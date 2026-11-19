# Session 11 - Défi

/mes-articles ne montre que mes articles, brouillons compris : oui
Un visiteur qui ouvre /mes-articles arrive sur /connexion : oui
Le cookie remember_web_ apparaît quand la case est cochée : oui
Les deux nouveaux tests passent et php artisan test est vert : oui

Pourquoi partir de $request->user()->posts() plutôt que de Post::where('user_id', $request->user()->id) ?
La relation porte déjà la condition sur l'utilisateur connecté et réduit le risque d'exposer ou modifier les articles d'un autre utilisateur.

Pourquoi la case remember ne doit-elle pas être dans le tableau passé à Auth::attempt() ?
`attempt()` utilise chaque clé du tableau comme une condition de recherche en base. `remember` ne doit donc pas être transmis comme identifiant : il sert uniquement au second argument, qui active la persistance de l'authentification.
