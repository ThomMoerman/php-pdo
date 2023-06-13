<?php
include('config.php');

// Traiter le formulaire d'ajout de rando
if (isset($_POST['name']) && isset($_POST['difficulty']) && isset($_POST['distance']) && isset($_POST['duration']) && isset($_POST['height_difference']) && isset($_POST['available'])) {
    $nom = $_POST['name'];
    $difficulty = $_POST['difficulty'];
    $distance = $_POST['distance'];
    if (!is_numeric($distance)) {
        die("Une erreur s'est produite. Veuillez réessayer plus tard.");
    }
    $duration = $_POST['duration'];
    // Vérifier si la durée est au format h:min:sec (par exemple, 2:30:00)
    if (!preg_match('/^\d+:\d{2}:\d{2}$/', $duration)) {
        die("Une erreur s'est produite. Veuillez réessayer plus tard.");
    }
    $height_difference = $_POST['height_difference'];
    if (!is_numeric($height_difference)) {
        die("Une erreur s'est produite. Veuillez réessayer plus tard.");
    }
    $available = $_POST['available'];

    $message = "";

    // Insérer les données dans la base de données
    $requete = $bdd->prepare('INSERT INTO hiking (name, difficulty, distance, duration, height_difference, available) VALUES (:name, :difficulty, :distance, :duration, :heightDifference, :available)');
    $requete->bindParam(':name', $nom);
    $requete->bindParam(':difficulty', $difficulty);
    $requete->bindParam(':distance', $distance);
    $requete->bindParam(':duration', $duration);
    $requete->bindParam(':heightDifference', $height_difference);
    $requete->bindParam(':available', $available);
    $requete->execute();
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Ajouter une randonnée</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>

<body>
    <a href="/php-pdo/read.php">Liste des données</a>
    <h1>Ajouter</h1>
    <form action="" method="post">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="">
        </div>

        <div>
            <label for="difficulty">Difficulté</label>
            <select name="difficulty">
                <option value="très facile">Très facile</option>
                <option value="facile">Facile</option>
                <option value="moyen">Moyen</option>
                <option value="difficile">Difficile</option>
                <option value="très difficile">Très difficile</option>
            </select>
        </div>

        <div>
            <label for="distance">Distance</label>
            <input type="text" name="distance" value="">
        </div>
        <div>
            <label for="duration">Durée</label>
            <input type="time" name="duration" value="" step="2">
        </div>
        <div>
            <label for="height_difference">Dénivelé</label>
            <input type="text" name="height_difference" value="">
        </div>
        <div>
            <label for="available">Disponibilité :</label>
            <select name="available">
                <option value="1">Disponible</option>
                <option value="0">Indisponible</option>
            </select><br><br>
        </div>
        <button type="submit" name="button">Envoyer</button>
    </form>

    <?php if (!empty($message)): ?>
        <span>
            <?php echo $message; ?>
        </span>
    <?php endif; ?>

</body>

</html>