<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', 'root123456', 'ecomint');

// Vérifiez la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Vérifier si une demande de suppression a été soumise
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $sql = "DELETE FROM `cart` WHERE `id` = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            // Renvoie un succès
            echo "success";
        } else {
            echo "Erreur lors de la suppression de l'article.";
        }
        $stmt->close();
    }
}

$conn->close();
?>
