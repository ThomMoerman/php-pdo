<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $name = $_POST['name'];
        $difficulty = $_POST['difficulty'];
        $distance = $_POST['distance'];
        $duration = $_POST['duration'];
        $height_difference = $_POST['height_difference'];
        $available = $_POST['available'];

        // Mettre à jour les informations dans la base de données
        $requete = $bdd->prepare('UPDATE hiking SET name = :name, difficulty = :difficulty, distance = :distance, duration = :duration, height_difference = :height_difference, available = :available WHERE id = :id');
        $requete->bindParam(':name', $name);
        $requete->bindParam(':difficulty', $difficulty);
        $requete->bindParam(':distance', $distance);
        $requete->bindParam(':duration', $duration);
        $requete->bindParam(':height_difference', $height_difference);
        $requete->bindParam(':available', $available);
        $requete->bindParam(':id', $id);
        $requete->execute();

        // Rediriger vers la page read.php après la mise à jour
        header('Location: read.php');
        exit;
    }

    // Récupérer les informations de la randonnée à partir de la base de données
    $requete = $bdd->prepare('SELECT * FROM hiking WHERE id = :id');
    $requete->bindParam(':id', $id);
    $requete->execute();
    $donnees = $requete->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Modifier une randonnée</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>

<body>
    <a href="/php-pdo/read.php">Liste des randonnées</a>
    <h1>Modifier</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $donnees['id']; ?>">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo $donnees['name']; ?>">
        </div>

        <div>
            <label for="difficulty">Difficulté</label>
            <select name="difficulty">
                <option value="très facile" <?php if ($donnees['difficulty'] === 'très facile') echo 'selected'; ?>>Très
                    facile</option>
                <option value="facile" <?php if ($donnees['difficulty'] === 'facile') echo 'selected'; ?>>Facile
                </option>
                <option value="moyen" <?php if ($donnees['difficulty'] === 'moyen') echo 'selected'; ?>>Moyen</option>
                <option value="difficile" <?php if ($donnees['difficulty'] === 'difficile') echo 'selected'; ?>>
                    Difficile</option>
                <option value="très difficile"
                    <?php if ($donnees['difficulty'] === 'très difficile') echo 'selected'; ?>>Très difficile</option>
            </select>
        </div>

        <div>
            <label for="distance">Distance</label>
            <input type="text" name="distance" value="<?php echo $donnees['distance']; ?>">
        </div>
        <div>
            <label for="duration">Durée</label>
            <input type="time" name="duration" value="<?php echo $donnees['duration']; ?>" step="2">
        </div>
        <div>
            <label for="height_difference">Dénivelé</label>
            <input type="text" name="height_difference" value="<?php echo $donnees['height_difference']; ?>">
        </div>
        <div>
            <label for="available">Disponibilité :</label>
            <select name="available">
                <option value="1" <?php if ($donnees['available']) echo 'selected'; ?>>Disponible</option>
                <option value="0" <?php if (!$donnees['available']) echo 'selected'; ?>>Indisponible</option>
            </select><br><br>
        </div>
        <button type="submit" name="button">Envoyer</button>
    </form>
</body>

</html>