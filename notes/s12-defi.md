# Session 12 - Défi

1. Pourquoi role n'est-il pas dans #[Fillable], et comment votre contrôleur le modifie-t-il quand même ?
Le rôle `role` n'est pas dans l'attribut `#[Fillable]` du modèle `User` pour des raisons de sécurité critiques : cela empêche l'assignation de masse (Mass Assignment). Si `role` était fillable, n'importe quel utilisateur pourrait envoyer `role=admin` lors de son inscription (`User::create($request->all())`) et devenir administrateur sans contrôle.
Le contrôleur modifie le rôle directement par affectation explicite de la propriété sur l'instance du modèle : `$user->role = ...; $user->save();`. Cette affectation directe contourne la protection contre le mass assignment tout en restant parfaitement sécurisée car elle est réservée aux administrateurs dans un contrôleur protégé.

2. Pourquoi le callback de Gate::before doit-il renvoyer null, et non false, pour un auteur ?
Dans Laravel, si le callback de `Gate::before` retourne `false`, l'autorisation est immédiatement et définitivement refusée, et Laravel n'exécute aucune des règles suivantes (les Gates déclarés ou les méthodes de la Policy). 
En renvoyant `null` pour un auteur (non-administrateur), `Gate::before` indique à Laravel qu'il ne prend pas de décision globale prioritaire et qu'il doit laisser les vérifications normales (les méthodes de la `PostPolicy` comme `update` et `delete` vérifiant si l'auteur est bien le propriétaire de l'article) déterminer si l'action est autorisée ou non. Renvoyer `false` interdirait à tout auteur de modifier ses propres articles.
