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
session_start(); // Assurez-vous que les sessions sont activées
$user_id = $_SESSION['user_id']; // Remplacez par l'ID de l'utilisateur connecté
// Calcul du total des produits dans le panier
$sql = "SELECT SUM(quantity * price) AS total FROM cart WHERE user_id = '$user_id'";
$result = $conn->query($sql);
if (!$result) {
    die("Erreur dans la requête SQL : " . $conn->error);
}
$total = 0;
$row = $result->fetch_assoc();
if ($row && $row['total'] !== null) {
    $total = $row['total'];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>Intérieur Decoration </title>
        <link rel="icon" href="img/logo.png" type="image/png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet"> 
        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="lib/animate/animate.min.css"/>
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style2.css" rel="stylesheet">
        <style>
        .modal-content {
            padding: 20px;
        }
    </style>
</head>
<body>
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Chargement...</span>
            </div>
        </div>
        <!-- Spinner End -->
       <!-- Topbar Start -->
       <div class="container-fluid topbar px-5 d-none d-lg-block">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
            <div class="d-flex flex-wrap">
                <a href="#" class="text-muted small me-4">
                    <i class="fas fa-map-marker-alt text-primary me-2"></i>Trouver nous
                </a>
                <a href="tel:+01234567890" class="text-muted small me-4">
                    <i class="fas fa-phone-alt text-primary me-2"></i>+21234567890
                </a>
                <a href="mailto:example@gmail.com" class="text-muted small me-0">
                    <i class="fas fa-envelope text-primary me-2"></i>Ammeubleumentdeco@gmail.com
                </a>
            </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <a href="register.php" class="me-3 text-dark">
                    <small><i class="fas fa-user text-primary me-2"></i>Register</small>
                </a>
                <a href="login.php" class="me-3 text-dark">
                    <small><i class="fas fa-sign-in-alt text-primary me-2"></i>Se connecter</small>
                </a>
                <?php if (isset($_SESSION['user_name'])): ?>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                        <small><i class="fas fa-home text-primary me-2"></i> <?php echo htmlspecialchars($_SESSION['user_name']); ?></small>
                    </a>
                    <ul class="dropdown-menu rounded">
                        <li><a href="#" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> Mon profil</a></li>
                        <li><a href="view_cart.php" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Panier</a></li>
                        <li><a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Favoris</a></li>
                        <li><a href="logout.php" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Se déconnecter</a></li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
       </div>
        <!-- Topbar End -->
        <!-- Navbar & Hero Start -->
<section>
    <div class="container-fluid position-relative p-0">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="index.php" class="navbar-brand p-0">
                <h1 class="text-primary" style="color: #c3b9ae !important;">
                    <img src="img/logo.png" alt="Logo" style="height: 70%; width: auto; margin-right: 10px;">
                    Intérieur Decoration
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">Accueil</a>
                    <a href="about.php" class="nav-item nav-link">Carrière</a>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="feature.html" class="dropdown-item">Catégorie 001</a></li>
                            <li><a href="team.html" class="dropdown-item">Catégorie 002</a></li>
                            <li><a href="testimonial.html" class="dropdown-item">Catégorie 003</a></li>
                            <li><a href="offer.html" class="dropdown-item">Catégorie 004</a></li>
                            <li><a href="FAQ.html" class="dropdown-item">Catégorie 005</a></li>
                        </ul>
                    </div>
                </div>
                <a href="#" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Explorer</a>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Carousel Start -->
        <div class="header-carousel owl-carousel">
            <div class="header-carousel-item">
                <img src="img/car1.jpg" class="img-fluid w-100" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row gy-0 gx-5">
                            <div class="col-xl-7 offset-xl-5 text-sm-center text-md-end animated fadeInLeft">
                                <h4 class="text-primary text-uppercase fw-bold mb-4">Bienvenue chez Intérieur Décoration</h4>
                                <h1 class="display-4 text-uppercase text-white mb-4">Investissez dans votre intérieur avec style</h1>
                                <p class="mb-5 fs-5">Chez Intérieur Décoration, nous transformons vos espaces en havres de paix. Explorez notre large gamme de meubles élégants et fonctionnels pour créer un environnement unique et accueillant.</p>
                                <div class="d-flex justify-content-center justify-content-md-end flex-shrink-0 mb-4">
                                    <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 me-2" href="#"><i class="fas fa-play-circle me-2"></i> Regarder la Vidéo</a>
                                    <a class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2" href="#">En Savoir Plus</a>
                                </div>
                                <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                                    <h2 class="text-white me-2">Suivez-Nous :</h2>
                                    <div class="d-flex justify-content-end ms-2">
                                        <a class="btn btn-md-square btn-light rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-md-square btn-light rounded-circle mx-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-md-square btn-light rounded-circle mx-2" href="#"><i class="fab fa-instagram"></i></a>
                                        <a class="btn btn-md-square btn-light rounded-circle ms-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-carousel-item">
                <img src="img/car2.png" class="img-fluid w-100" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-5">
                            <div class="col-12 text-center animated fadeInUp">
                                <h4 class="text-primary text-uppercase fw-bold mb-4">Bienvenue chez Intérieur Décoration</h4>
                                <h1 class="display-4 text-uppercase text-white mb-4">Élevez votre style de vie avec nos meubles de qualité</h1>
                                <p class="mb-5 fs-5">Découvrez des pièces de mobilier exceptionnelles qui marient confort et esthétique. Chaque meuble est conçu pour ajouter une touche d'élégance à votre espace de vie.</p>
                                <div class="d-flex justify-content-center flex-shrink-0 mb-4">
                                    <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 me-2" href="#"><i class="fas fa-play-circle me-2"></i> Regarder la Vidéo</a>
                                    <a class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2" href="#">En Savoir Plus</a>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <h2 class="text-white me-2">Suivez-Nous :</h2>
                                    <div class="d-flex justify-content-end ms-2">
                                        <a class="btn btn-md-square btn-light rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-md-square btn-light rounded-circle mx-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-md-square btn-light rounded-circle mx-2" href="#"><i class="fab fa-instagram"></i></a>
                                        <a class="btn btn-md-square btn-light rounded-circle ms-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->
    </div>
</section>
        <!-- Navbar & Hero End -->

<!-- Checkout formulaire -->
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-6" style="margin-left: -10px;">
            <div class="card" style="border: none;">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Checkout</h4>
                    <!-- Checkout formulaire -->
                    <form id="checkoutForm" action="confirm_order.php" method="post">
                        <div class="form-group mb-3">
                            <label for="total">Total:</label>
                            <input type="text" id="total" name="total" value="<?php echo number_format($total, 2, '.', ''); ?>" readonly class="form-control">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="discount_code">Code de réduction:</label>
                            <input type="text" id="discount_code" name="discount_code" class="form-control">
                            <button type="button" id="apply_discount" class="btn btn-primary mt-2">Utiliser ce code pour -10%</button>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="final_total">Total après remise:</label>
                            <input type="text" id="final_total" name="final_total" value="<?php echo number_format($total, 2, '.', ''); ?>" readonly class="form-control">
                        </div>
                        
                        <button type="button" id="finalizeOrderBtn" class="btn btn-success btn-lg btn-block" style="margin-top:7%">Finaliser la commande</button>
                    </form>

                    <!-- Formulaire d'information de livraison (caché par défaut) -->
                    <div id="shippingForm" class="mt-5" style="display:none;">
                        <h4 class="text-center">Informations de livraison</h4>
                        <form id="shippingDetailsForm" action="confirm_order.php" method="post">
                            <div class="form-group mb-3">
                                <label for="name">Nom:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="address">Adresse:</label>
                                <input type="text" id="address" name="address" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="delivery_date">Date de livraison:</label>
                                <input type="date" id="delivery_date" name="delivery_date" class="form-control" required>
                            </div>
                            <input type="hidden" name="final_total" id="hidden_final_total" value="<?php echo $total; ?>">
                            <button type="submit" id="validateDelivery" class="btn btn-primary btn-lg btn-block mt-3">Valider la livraison</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Thank You Modal -->
<div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="thankYouModalLabel">Merci pour votre commande!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Votre commande a été validée avec succès. Nous vous remercions pour votre confiance !
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s" style="background:rgb(27, 16, 12);">
    <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="footer-item">
                    <a href="index.html" class="p-0">
                        <h4 class="text-white"><i class="fas fa-couch me-3"></i>Décor & Meubles</h4>
                    </a>
                    <p class="mb-4">Explorez notre vaste collection de meubles et de décoration intérieure. Transformez votre espace en un lieu unique avec nos produits de qualité.</p>
                    <div class="d-flex">
                        <a href="#" class="bg-primary d-flex rounded align-items-center py-2 px-3 me-2">
                            <i class="fas fa-apple-alt text-white"></i>
                            <div class="ms-3">
                                <small class="text-white">Téléchargez sur</small>
                                <h6 class="text-white">App Store</h6>
                            </div>
                        </a>
                        <a href="#" class="bg-dark d-flex rounded align-items-center py-2 px-3 ms-2">
                            <i class="fas fa-play text-primary"></i>
                            <div class="ms-3">
                                <small class="text-white">Obtenez-le sur</small>
                                <h6 class="text-white">Google Play</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-2">
                <div class="footer-item">
                    <h4 class="text-white mb-4">Liens Rapides</h4>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> À Propos</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Nouveautés</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Collections</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Promotions</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Blog</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Contactez-nous</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="text-white mb-4">Support</h4>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Politique de Confidentialité</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Conditions Générales</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Avertissement</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Support Client</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> FAQ</a>
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Aide</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="text-white mb-4">Infos Contact</h4>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                        <p class="text-white mb-0">123 Rue du Design, Rabat, MOROCCO</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-envelope text-primary me-3"></i>
                        <p class="text-white mb-0">contact@vInterieurDeco.com</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa fa-phone-alt text-primary me-3"></i>
                        <p class="text-white mb-0">+21234567890</p>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <i class="fab fa-firefox-browser text-primary me-3"></i>
                        <p class="text-white mb-0">www.vInterieurDeco.com</p>
                    </div>
                    <div class="d-flex">
                        <a href="#" class="btn btn-outline-light rounded-circle me-2">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light rounded-circle me-2">
                            <i class="fab fa-twitter text-white"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light rounded-circle me-2">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light rounded-circle">
                            <i class="fab fa-linkedin-in text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
<!-- Script pour afficher le formulaire de livraison et la modal de remerciement -->
<script>
document.getElementById('finalizeOrderBtn').addEventListener('click', function() {
    // Masquer le bouton "Finaliser la commande" et afficher le formulaire de livraison
    document.getElementById('checkoutForm').style.display = '';
    document.getElementById('shippingForm').style.display = 'block';
});

document.getElementById('validateDelivery').addEventListener('click', function(event) {
    event.preventDefault(); // Empêcher le formulaire d'être soumis immédiatement

    // Simulation de validation des données de livraison
    var name = document.getElementById('name').value;
    var address = document.getElementById('address').value;
    var deliveryDate = document.getElementById('delivery_date').value;

    if (name && address && deliveryDate) {
        // Si les champs sont remplis, afficher la modal de remerciement
        var thankYouModal = new bootstrap.Modal(document.getElementById('thankYouModal'));
        thankYouModal.show();

        // Après avoir affiché la modal, soumettre le formulaire pour sauvegarder les données
        document.getElementById('shippingDetailsForm').submit();
    } else {
        alert('Veuillez remplir tous les champs de livraison.');
    }
});

// Afficher la modal de remerciement si l'URL contient "success=true"
window.onload = function() {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === 'true') {
        var thankYouModal = new bootstrap.Modal(document.getElementById('thankYouModal'));
        thankYouModal.show();
    }
};
</script>



<!-- Ajoutez les scripts Bootstrap ici -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>







<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="js/main.js"></script>
    <!-- Le script pour appliquer le code coupon -->
<script> document.getElementById('apply_discount').addEventListener('click', function() {
    const discountCode = 'PL9U6';
    document.getElementById('discount_code').value = discountCode;

    const total = parseFloat(document.getElementById('total').value);
    const discount = total * 0.10;
    const finalTotal = total - discount;
    
    document.getElementById('final_total').value = finalTotal.toFixed(2);
});</script>

</body>
</html>

