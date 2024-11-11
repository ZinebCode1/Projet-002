
<?php
session_start();
include 'db_connect.php';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; // Assure-toi que la valeur est correcte
$cart_query = "
    SELECT c.product_id, c.quantity, c.price, p.nom,p.description,c.id
    FROM cart c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = ?";
$stmt = $conn->prepare($cart_query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <title>Intérieur Decoration </title>
        <link rel="icon" href="img/logo.png" type="image/png">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet"> -->
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
        .card-img-placeholder {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        font-size: 2rem;
        color: #6c757d;
    }
    .total-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
    }
    .total-amount {
        font-size: 1.5rem;
        font-weight: bold;
    }
    .product-name {
        font-size: 1.25rem; /* Adjust the size */
        font-weight: bold;
        color: #343a40; /* Dark color for better contrast */
        text-transform: uppercase; /* Optional: Transform text to uppercase */
        letter-spacing: 0.05rem; /* Optional: Add spacing between letters */
        margin-bottom: 0.5rem; /* Space below the title */
    }
    .text-label {
        font-weight: normal; /* Remove boldness */
        color: #495057; /* Slightly lighter color for labels */
    }
    .card-text {
        font-size: 1rem; /* Adjust the font size */
        color: #212529; /* Darker color for better readability */
    }
    </style>
</head>
<body>
      <!-- Topbar Start -->
      <div class="container-fluid topbar  px-5 d-none d-lg-block">
            <div class="row gx-0 align-items-center">
                <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-flex flex-wrap">
                        <a href="#" class="text-muted small me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Trouver nous</a>
                        <a href="tel:+01234567890" class="text-muted small me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+21234567890</a>
                        <a href="mailto:example@gmail.com" class="text-muted small me-0"><i class="fas fa-envelope text-primary me-2"></i>Ammeubleumentdeco @gmail.com</a>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <a href="register.php"><small class="me-3 text-dark"><i class="fas fa-user text-primary me-2"></i>Creer un compte</small></a>
                <a href="login.php"><small class="me-3 text-dark"><i class="fas fa-sign-in-alt text-primary me-2"></i>Se connecter</small></a>
                
                <?php if (isset($_SESSION['user_name'])): ?>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown">
                        <small><i class="fas fa-home text-primary me-2"></i> <?php echo htmlspecialchars($_SESSION['user_name']); ?></small>
                    </a>
                    <div class="dropdown-menu rounded">
                        <a href="profile_edit.php" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> Mon profil</a>
                        <a href="view_cart.php" class="dropdown-item"><i class="fas fa-shopping-cart me-2"></i> Panier</a>
                        <!-- <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Favoris</a> -->
                        <a href="logout.php" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Se déconnecter</a>
                    </div>
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
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary" style="color:#c3b9ae !important;">
                  <img src="img/logo.png" alt="Logo" style="height: 70%; width: auto; margin-right: 10px;">
                     Intérieur Decoration
                  </h1>
                   </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index.php" class="nav-item nav-link">Acceuil</a>
                        <a href="about.php" class="nav-item nav-link">Cariere</a>
                        <a href="contact.php" class="nav-item nav-link">Contacter Nous </a>
                        <a href="view_cart.php" class="nav-item nav-link active">Panier</a>

                    </div>
                    <a href="#" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Explorer</a>
                </div>
            </nav>
<!-- Carousel Start -->
<div class="header-carousel owl-carousel">
    <div class="header-carousel-item">
        <img src="img/car1.jpg" class="img-fluid w-100" alt="Image">
        <div class="carousel-caption">
            <div class="container">
                <div class="row gy-0 gx-5">
                    <div class="col-lg-0 col-xl-5"></div>
                    <div class="col-xl-7 animated fadeInLeft">
                        <div class="text-sm-center text-md-end">
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
                                    <a class="btn btn-md-square btn-light rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-md-square btn-light rounded-circle ms-2" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
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
                    <div class="col-12 animated fadeInUp">
                        <div class="text-center">
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
                                    <a class="btn btn-md-square btn-light rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-md-square btn-light rounded-circle ms-2" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
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
<!-- Retour  -->
<section>
    <div class="container my-5">
    <div class="d-flex align-items-center mb-4">
    <a href="index.php#products-section" class="btn btn-primary me-3" style="display: inline-flex; align-items: center;">
                <i class="fas fa-arrow-left"></i>
            </a>
        <h2 class="text-center">Votre Panier</h2>
    </div>
        <!-- Afficher un message de confirmation de suppression -->
        <div id="confirmation-message" class="alert alert-success" style="display: none;">
            L'article a été supprimé avec succès !
        </div>
        <?php while ($row = $result->fetch_assoc()): 
            $itemTotal = $row['quantity'] * $row['price'];
            $total += $itemTotal;
        ?>
            <div class="card mb-3 cart-item" data-item-total="<?php echo $itemTotal; ?>">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="card-img-placeholder">
                            <i class="fas fa-box"></i> <!-- Icône de produit -->
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title product-name"><?php echo htmlspecialchars($row['nom']); ?></h5>
                            <p class="card-text"><span class="text-label">Description:</span> <?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="card-text"><strong>Prix:</strong> <?php echo htmlspecialchars($row['price']); ?> MAD</p>
                            <p class="card-text"><strong>Total:</strong> <?php echo htmlspecialchars($itemTotal); ?> MAD</p>
                            <!-- Formulaire pour suppression avec icône de corbeille -->
                            <form class="delete-form" style="display: inline;">
                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                <button type="button" class="btn btn-link p-0 delete-button" style="color: red;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <div class="total-container">
            <div class="total-amount">
                Total du Panier: <span id="cart-total"><?php echo number_format($total, 2, '.', ''); ?></span> MAD
            </div>
            <a href="checkout.php" class="btn btn-success btn-lg">Passer au Paiement</a>
        </div>
    </div>
</section>
<!-- Ajouter jQuery pour faciliter la manipulation du DOM et les requêtes AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').click(function() {
            var form = $(this).closest('form');
            var deleteId = form.find('input[name="delete_id"]').val();
            var itemCard = form.closest('.cart-item');
            var itemTotal = parseFloat(itemCard.data('item-total'));
            $.ajax({
                url: 'delete_from_cart.php',
                type: 'POST',
                data: { delete_id: deleteId },
                success: function(response) {
                    if (response === 'success') {
                        // Afficher le message de confirmation
                        $('#confirmation-message').show();
                        // Supprimer l'article de la page
                        itemCard.remove();
                        // Mettre à jour le total du panier
                        var currentTotal = parseFloat($('#cart-total').text());
                        var newTotal = currentTotal - itemTotal;
                        $('#cart-total').text(newTotal.toFixed(2));
                    } else {
                        alert("Erreur lors de la suppression de l'article.");
                    }
                },
                error: function() {
                    alert("Erreur lors de la suppression de l'article.");
                }
            });
        });
    });
</script>

<!-- Ajouter jQuery pour faciliter la manipulation du DOM et les requêtes AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>





     <!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s" style="background:rgb(27 16 12);">
    <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="footer-item">
                    <a href="index.html" class="p-0">
                        <h4 class="text-white"><i class="fas fa-couch me-3"></i>Décor & Meubles</h4>
                        <!-- <img src="img/logo.png" alt="Logo"> -->
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
                        <p class="text-white mb-0">Ammeubleumentdeco@gmail.com</p>
                    </div>
                    <div class="d-flex">
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-facebook-f text-white"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-twitter text-white"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-instagram text-white"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="#"><i class="fab fa-linkedin-in text-white"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
        
      

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   
        
<!-- JavaScript Libraries -->
 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
<?php
$stmt->close();
$conn->close();
?>
