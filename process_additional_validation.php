<?php
session_start(); // Assurez-vous que la session est démarrée

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si les champs sont définis et non vides
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $availability = isset($_POST['availability']) ? $_POST['availability'] : '';
    $total = isset($_POST['total']) ? $_POST['total'] : '';

    // Assurez-vous que la variable de session user_id est définie
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

    // Vérifiez que les données sont valides avant de les utiliser
    if (empty($name) || empty($address) || empty($phone) || empty($availability) || empty($total) || $user_id === 0) {
        die("Erreur: Les informations requises sont manquantes.");
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', 'root123456', 'ecomint');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO final_commande (user_id, name, address, phone, availability, total) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $name, $address, $phone, $availability, $total);

    // Execute statement
    if ($stmt->execute()) {
        // If successful, show an alert and redirect
            echo "<script>
                    alert('Commande enregistrée avec succès.');
                    window.location.href = 'index.php'; // Redirige vers la page d'accueil
                </script>";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
