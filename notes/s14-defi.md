# Session 14 - Défi

Connexion enregistre le jeton toute seule : oui
Créer un article répond 201 sans copier le jeton : oui
Le fichier exporté ne contient aucun jeton : oui

Le dépôt est public. Que risquez-vous si le fichier exporté contient un jeton, et comment l'annuler ?
N'importe qui trouvant ce jeton sur un dépôt public peut agir en notre nom sur l'API tant que le jeton n'est pas révoqué, d'autant que par défaut dans Sanctum, les jetons personnels n'expirent jamais. Pour l'annuler, il faut immédiatement révoquer le jeton en appelant l'endpoint `/api/logout` avec ce jeton, ou en supprimant directement sa ligne dans la table `personal_access_tokens` de la base de données.

Pourquoi les écritures de l'API passent-elles par les Form Requests et PostPolicy plutôt que par des règles écrites dans Api\PostController ?
Une règle pour deux portes : centraliser la validation dans les Form Requests et l'autorisation dans la PostPolicy garantit qu'un changement de règle métier s'applique instantanément au site web et à l'API en même temps. Cela évite les duplications de logique, assure qu'aucune incohérence ou contradiction n'apparaisse entre le web et l'API, et facilite grandement la maintenance ainsi que la sécurité de l'application.
