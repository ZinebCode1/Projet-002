<!-- Here  -->
<?php
$servername = "localhost";
$username = "root";
$password = "root123456";
$dbname = "ecomint";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
?>
