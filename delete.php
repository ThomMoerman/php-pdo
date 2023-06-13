<?php
include('config.php');

// Vérifier si l'identifiant de la randonnée est présent
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Effectuer la suppression de la randonnée
    
    $requete = $bdd->prepare('DELETE FROM hiking WHERE id = :id');
    $requete->bindParam(':id', $id);
    $requete->execute();
    $donnees = $requete->fetch(PDO::FETCH_ASSOC);

    // Redirection vers la page read.php
    header("Location: read.php");
    exit();
}
?>