
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Heure</title>
</head>
<body>

    <h1>Heure actuelle</h1>

    <p>Heure : {{ now()->format('H:i') }}</p>
    <p>Date : {{ now()->format('d/m/Y') }}</p>

</body>
</html>

