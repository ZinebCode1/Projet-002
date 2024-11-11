<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'ecomint';
$username = 'root';
$password = 'root123456';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0; // Assure-toi que user_id est un entier
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $project = htmlspecialchars($_POST['project']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Assure-toi que user_id est valide avant d'exécuter la requête
    if ($user_id > 0) {
        // Insérer les données dans la table `contact`
        $sql = "INSERT INTO contact (user_id, name, email, phone, project, subject, message) VALUES (:user_id, :name, :email, :phone, :project, :subject, :message)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':project', $project);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            header("Location: contact.php?status=success");
        } else {
            echo "Une erreur est survenue. Veuillez réessayer.";
        }
    } else {
        header("Location: contact.php?status=error");

    }
}
?>