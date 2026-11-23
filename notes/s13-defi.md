# Session 13 - Défi

/api/posts/3 affiche tags avec des noms : oui
/api/posts ne contient aucun body, /api/posts/3 en contient un : oui
Aucune LazyLoadingViolationException : oui

Pourquoi ne pas envoyer body dans la liste, et qui en profite ?
Le champ `body` contient le texte intégral de l'article, qui peut être très long (plusieurs kilo-octets ou méga-octets). Ne pas l'envoyer dans la liste allège considérablement la réponse JSON et économise la bande passante réseau, tout en accélérant le temps de réponse et de parsing. En profitent particulièrement les utilisateurs sur mobile ou avec une connexion limitée/lente, ainsi que le serveur en réduisant la charge de transfert réseau et la mémoire consommée pour sérialiser les données.

Un brouillon renvoie 403. Quel avantage aurait un 404 pour un brouillon ?
Renvoyer 404 au lieu de 403 pour un brouillon permet de masquer totalement son existence aux utilisateurs non autorisés. Avec une réponse 403, un attaquant ou un curieux sait qu'une ressource existe avec cet identifiant mais qu'elle lui est interdite (divulgation d'informations / énumération). Avec une réponse 404, il ne peut pas distinguer un article inexistant d'un article en brouillon non publié.
