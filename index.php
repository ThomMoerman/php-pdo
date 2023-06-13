<?php
try
{
    // On se connecte a MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'root');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrete tout
    die('Erreur : '.$e->getMessage());
}

// Recuperer les donnees de la table "Météo"
$requete = $bdd->query('SELECT * FROM Météo');
$donnees = $requete->fetchAll(PDO::FETCH_ASSOC);

// Traiter le formulaire d'ajout de villes
if(isset($_POST['ville']) && isset($_POST['haut']) && isset($_POST['bas'])) {
    $ville = $_POST['ville'];
    $haut = $_POST['haut'];
    $bas = $_POST['bas'];

    // Insérer les données dans la table "Météo"
    $insertion = $bdd->prepare('INSERT INTO Météo (ville, haut, bas) VALUES (?, ?, ?)');
    $insertion->execute(array($ville, $haut, $bas));

    header('Location: '.$_SERVER['PHP_SELF']);

    exit();
}

// Traiter la suppression des villes
if(isset($_POST['supprimer'])) {
    $villeASupprimer = $_POST['supprimer'];

    // Supprimer la ville de la table "Météo"
    $suppression = $bdd->prepare('DELETE FROM Météo WHERE ville = ?');
    $suppression->execute(array($villeASupprimer));

    header('Location: '.$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Weather App</title>
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
    <h1>Weather App</h1>

    <h2>Liste des villes</h2>
    <table>
        <tr>
            <th>Ville</th>
            <th>Température maximale</th>
            <th>Température minimale</th>
            <th>Supprimer</th>
        </tr>
        <?php foreach($donnees as $row): ?>
        <tr>
            <td><?php echo $row['ville']; ?></td>
            <td><?php echo $row['haut']; ?></td>
            <td><?php echo $row['bas']; ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="supprimer" value="<?php echo $row['ville']; ?>">
                    <input type="submit" value="Supprimer">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Ajouter une ville</h2>
    <form method="post" action="?">
        <label for="ville">Ville:</label>
        <input type="text" id="ville" name="ville" required><br><br>

        <label for="haut">Température maximale:</label>
        <input type="text" id="haut" name="haut" required><br><br>

        <label for="bas">Température minimale:</label>
        <input type="text" id="bas" name="bas" required><br><br>

        <input type="submit" value="Ajouter">
    </form>
</body>
</html>