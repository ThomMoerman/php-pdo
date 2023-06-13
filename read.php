<?php
include('config.php');

$requete = $bdd->query('SELECT * FROM hiking');
$donnees = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>RandoList</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Randonnées</h1>

    <h2>Liste des randos</h2>
    <table>
        <tr>
            <th>Nom</th>
            <th>Difficulté</th>
            <th>Distance (Km)</th>
            <th>Durée (h:min:sec)</th>
            <th>Dénivelé (m) </th>
            <th>Disponibilité</th>
        </tr>
        <?php foreach($donnees as $row): ?>
        <tr>
        <td><a href="update.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
            <td><?php echo $row['difficulty']; ?></td>
            <td><?php echo $row['distance']; ?></td>
            <td><?php echo $row['duration']; ?></td>
            <td><?php echo $row['height_difference']; ?></td>
            <td><?php echo $row['available'] ? 'Disponible' : 'Indisponible'; ?></td>
            <td>
            <form action="delete.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette randonnée ?')">Supprimer</button>
            </form>
        </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="/php-pdo/create.php">Ajouter une randonnée</a>
</body>
</html>