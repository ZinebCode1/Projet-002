<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root123456";
$dbname = "ecomint";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupération des données du formulaire et de l'utilisateur
session_start();
$user_id = $_SESSION['user_id'];
$total_final = $_POST['final_total'];
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$availability = $_POST['delivery_date']; // Assuming delivery_date is the availability

// Insertion dans la table commandes
$sql = "INSERT INTO commandes (user_id, total_final) VALUES ('$user_id', '$total_final')";

if ($conn->query($sql) === TRUE) {
    // Récupération de l'ID de la commande insérée
    $order_id = $conn->insert_id;

    // Insertion dans la table final_commande
    $sql_final = "INSERT INTO final_commande (user_id, name, address, phone, availability, total, created_at) VALUES ('$user_id', '$name', '$address', '$phone', '$availability', '$total_final', NOW())";

    if ($conn->query($sql_final) === TRUE) {
        $success = true;
    } else {
        $success = false;
    }
} else {
    $success = false;
}

$conn->close();

// Redirection avec un paramètre pour afficher la modal
header("Location: checkout.php?success=" . ($success ? "true" : "false"));
exit();
?>
