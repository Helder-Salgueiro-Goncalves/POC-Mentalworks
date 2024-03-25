<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des newsletters</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>

<?php
    // Effectuer une requête HTTP GET vers l'API
    $api_url = "http://51.91.108.32/newsletters";
    $response = file_get_contents($api_url);

    // Vérifier si la réponse est valide
    if ($response === false) {
        die('Erreur lors de la récupération des données depuis l\'API.');
    }

    // Décoder la réponse JSON en tableau associatif
    $data = json_decode($response, true);

    // Vérifier si le décodage JSON a réussi
    if ($data === null) {
        die('Erreur lors du décodage des données JSON.');
    }
?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Contenu</th>
            <th>Intérêts</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $item) : ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo isset($item['title']) ? $item['title'] : 'Titre non disponible'; ?></td>
                <td><?php echo isset($item['content']) ? $item['content'] : 'Contenu non disponible'; ?></td>
                <td>
                    <?php
                        if (isset($item['interests'])) {
                            if (is_array($item['interests'])) {
                                echo implode(", ", $item['interests']);
                            } else {
                                echo $item['interests'];
                            }
                        } else {
                            echo 'Intérêts non disponibles';
                        }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>