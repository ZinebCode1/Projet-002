<?php
session_start();
// here 
include 'db_connect.php';  // Connexion à la base de données

$user_id = $_SESSION['user_id'];  // ID de l'utilisateur connecté
$product_id = $_POST['product_id'];

// Récupérer le prix actuel du produit
$product_query = "SELECT prix FROM products WHERE id = ?";
$stmt = $conn->prepare($product_query);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$product_price = $product['prix'];

// Vérifiez si le produit est déjà dans le panier
$cart_query = "SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($cart_query);
$stmt->bind_param('ii', $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Le produit est déjà dans le panier, mettre à jour la quantité
    $cart_item = $result->fetch_assoc();
    $new_quantity = $cart_item['quantity'] + 1;
    $update_cart = "UPDATE cart SET quantity = ? WHERE id = ?";
    $stmt = $conn->prepare($update_cart);
    $stmt->bind_param('ii', $new_quantity, $cart_item['id']);
    $stmt->execute();
} else {
    // Ajouter le produit au panier
    $insert_cart = "INSERT INTO cart (user_id, product_id, quantity, price) VALUES (?, ?, 1, ?)";
    $stmt = $conn->prepare($insert_cart);
    $stmt->bind_param('iid', $user_id, $product_id, $product_price);
    $stmt->execute();
}

// Rediriger vers la page du panier
header("Location: view_cart.php");
exit();
?>

