<?php
// La session de chaque user 
session_start();
$isUserLoggedIn = isset($_SESSION['user_id']); // Vérifiez si l'utilisateur est connecté
include 'db_connect.php';
// Fetch products from the database
$query = "SELECT * FROM products";
$result = $conn->query($query);
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
    </style>
    </head>
    <body>

<!-- Modal de promostion -->
<div class="modal fade" id="promotionModal" tabindex="-1" aria-labelledby="promotionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="promotionModalLabel">Promotion Spéciale</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h3>Achetez notre Best-Seller et Profitez de -10% !</h3>
       <p>Ne manquez pas cette offre exclusive ! Bénéficiez de 10 % de réduction sur notre produit phare. Style, qualité et confort à un prix exceptionnel !</p>
        <!-- Ajouter l'image ici -->
        <img src="img/best.png" alt="Promotion Image" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
       <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Chargement...</span>
            </div>
        </div>
        <!-- Spinner End -->

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
                        <a href="index.php" class="nav-item nav-link active">Acceuil</a>
                        <a href="about.php" class="nav-item nav-link">Cariere</a>
                        <a href="view_cart.php" class="nav-item nav-link">Panier</a>
                        <a href="contact.php" class="nav-item nav-link">Contacter Nous </a>
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
</section>
<!-- Navbar & Hero End -->


<!--  1 A propos de Nous Start -->
<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.2s">
                <div>
                    <h4 class="text-primary">À propos de Nous</h4>
                    <h1 class="display-5 mb-4">Découvrez notre entreprise, ne manquez pas l'opportunité</h1>
                    <p class="mb-4">Nous sommes une entreprise dédiée à l'ameublement, offrant des produits de qualité qui allient confort et design. Depuis nos débuts, nous nous engageons à fournir des meubles adaptés à tous les goûts et besoins, alliant style et fonctionnalité.</p>
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="d-flex">
                                <div><i class="fas fa-lightbulb fa-3x text-primary"></i></div>
                                <div class="ms-4">
                                    <h4>Consultation Personnalisée</h4>
                                    <p>Nos experts sont à votre disposition pour vous conseiller dans le choix de vos meubles.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="d-flex">
                                <div><i class="bi bi-bookmark-heart-fill fa-3x text-primary"></i></div>
                                <div class="ms-4">
                                    <h4>Années d'Expertise</h4>
                                    <p>Avec plusieurs années d'expérience, nous sommes leaders dans le domaine de l'ameublement.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <a href="#" class="btn btn-primary rounded-pill py-3 px-5 flex-shrink-0">Découvrez Maintenant</a>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex">
                                <i class="fas fa-phone-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Appelez-Nous</h4>
                                    <p class="mb-0 fs-5" style="letter-spacing: 1px;">+21234567890</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 wow fadeInRight" data-wow-delay="0.2s">
                <img src="img/about image.jpg" alt="À propos Image" class="img-fluid">
            </div>
        </div>
    </div>
</div>
<!-- A propos de Nous End -->

<!-- Features Start -->
<div class="container-fluid feature pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Nos Fonctionnalités</h4>
            <h1 class="display-5 mb-4">Transformez votre espace avec nos produits de décoration intérieure.</h1>
            <p class="mb-0">Découvrez nos solutions uniques pour meubler et décorer chaque coin de votre maison. De l'élégance du salon aux confortables chambres, nous offrons des produits de qualité qui ajoutent du style et du confort à votre intérieur.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                <div class="feature-item p-4">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-couch fa-4x text-primary"></i>
                    </div>
                    <h4>Mobilier Élégant</h4>
                    <p class="mb-4">Nos meubles allient design moderne et confort pour créer des espaces accueillants et élégants. Trouvez le mobilier parfait pour chaque pièce de votre maison.</p>
                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">En Savoir Plus</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                <div class="feature-item p-4">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-paint-roller fa-4x text-primary"></i>
                    </div>
                    <h4>Décoration Intérieure</h4>
                    <p class="mb-4">Ajoutez une touche personnelle à votre espace avec notre gamme de décorations intérieures. De l'art mural aux accessoires, nous avons tout ce qu'il faut pour personnaliser votre intérieur.</p>
                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">En Savoir Plus</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                <div class="feature-item p-4">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-bed fa-4x text-primary"></i>
                    </div>
                    <h4>Chambres Confortables</h4>
                    <p class="mb-4">Créez une chambre de rêve avec notre sélection de lits, matelas et linge de lit de haute qualité. Confort et élégance sont au rendez-vous pour des nuits reposantes.</p>
                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">En Savoir Plus</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                <div class="feature-item p-4">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-lightbulb fa-4x text-primary"></i>
                    </div>
                    <h4>Éclairage Unique</h4>
                    <p class="mb-4">Illuminez votre intérieur avec nos solutions d'éclairage innovantes. Des luminaires modernes aux designs traditionnels, nous avons des options pour tous les styles.</p>
                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">En Savoir Plus</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features End -->



<!-- Offer Start -->
<div class="container-fluid offer-section pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Nos Offres</h4>
            <h1 class="display-5 mb-4">Les Avantages que Nous Offrons</h1>
            <p class="mb-0">Découvrez les avantages exclusifs que nous proposons pour enrichir votre expérience d'achat de meubles et de décoration intérieure. Profitez de nos offres pour améliorer votre intérieur avec des produits de qualité.</p>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-xl-5 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="nav nav-pills bg-light rounded p-5">
                    <a class="accordion-link p-4 active mb-4" data-bs-toggle="pill" href="#offerOne">
                        <h5 class="mb-0">Remises spéciales sur les meubles de salon</h5>
                    </a>
                    <a class="accordion-link p-4 mb-4" data-bs-toggle="pill" href="#offerTwo">
                        <h5 class="mb-0">Offres exclusives sur les ensembles de chambre à coucher</h5>
                    </a>
                    <a class="accordion-link p-4 mb-4" data-bs-toggle="pill" href="#offerThree">
                        <h5 class="mb-0">Livraison gratuite sur toutes les commandes</h5>
                    </a>
                    <a class="accordion-link p-4 mb-0" data-bs-toggle="pill" href="#offerFour">
                        <h5 class="mb-0">Conseils de décoration gratuits de nos experts</h5>
                    </a>
                </div>
            </div>
            <div class="col-xl-7 wow fadeInRight" data-wow-delay="0.4s">
                <div class="tab-content">
                    <div id="offerOne" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-md-7">
                                <img src="img/feat1.png" class="img-fluid w-100 rounded" alt="Remises spéciales sur les meubles de salon">
                            </div>
                            <div class="col-md-5">
                                <h1 class="display-5 mb-4">Profitez de remises exceptionnelles sur nos meubles de salon</h1>
                                <p class="mb-4">Réaménagez votre salon avec style grâce à nos offres spéciales. Découvrez des réductions attractives sur une large sélection de meubles de salon modernes et élégants.</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">En Savoir Plus</a>
                            </div>
                        </div>
                    </div>
                    <div id="offerTwo" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-7">
                                <img src="img/feat2.png" class="img-fluid w-100 rounded" alt="Offres exclusives sur les ensembles de chambre à coucher">
                            </div>
                            <div class="col-md-5">
                                <h1 class="display-5 mb-4">Ensembles de chambre à coucher avec offres exclusives</h1>
                                <p class="mb-4">Créez une chambre de rêve avec nos ensembles de chambre à coucher à prix réduit. Bénéficiez d'offres exclusives pour améliorer le confort et le style de votre espace de repos.</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">En Savoir Plus</a>
                            </div>
                        </div>
                    </div>
                    <div id="offerThree" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-7">
                                <img src="img/feat3.png" class="img-fluid w-100 rounded" alt="Livraison gratuite sur toutes les commandes">
                            </div>
                            <div class="col-md-5">
                                <h1 class="display-5 mb-4">Livraison gratuite sur toutes les commandes</h1>
                                <p class="mb-4">Profitez de la livraison gratuite sur toutes vos commandes de meubles et de décoration intérieure. Une opportunité parfaite pour recevoir vos produits sans frais supplémentaires.</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">En Savoir Plus</a>
                            </div>
                        </div>
                    </div>
                    <div id="offerFour" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-7">
                                <img src="img/feat4.png" class="img-fluid w-100 rounded" alt="Conseils de décoration gratuits de nos experts">
                            </div>
                            <div class="col-md-5">
                                <h1 class="display-5 mb-4">Conseils de décoration gratuits de nos experts</h1>
                                <p class="mb-4">Recevez des conseils de décoration gratuits de la part de nos experts pour optimiser l'aménagement et la décoration de votre intérieur. Nous vous aidons à créer des espaces qui vous ressemblent.</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">En Savoir Plus</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->

<!-- Modal d'alerte pour connexion a chaque click avant connexion-->
<div class="modal fade" id="loginAlertModal" tabindex="-1" aria-labelledby="loginAlertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginAlertModalLabel">Attention</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Vous devez créer un compte et vous connecter pour ajouter des produits au panier!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <a href="login.php" class="btn btn-primary">Se connecter </a> <!-- Remplacez 'login.php' par le chemin vers votre page de connexion -->
            </div>
        </div>
    </div>
</div>

<!-- Section des produits -->
<section class="section" id="products-section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h2 class="posts-entry-title">Nos Produits</h2>
            </div>
           
        </div>

        <div class="row">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()): ?>
                    <div class="col-lg-4 mb-4">
                        <div class="post-entry-alt">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#productModal<?php echo htmlspecialchars($row['id']); ?>">
                                <img src="admin/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['nom']); ?>" class="img-fluid">
                            </a>
                            <div class="excerpt" style="text-align: center;">
                                <h2 class="product-name" style="font-size: 1.5rem; margin: 0.5rem 0;">
                                    <a href="single_product.php?id=<?php echo htmlspecialchars($row['id']); ?>">
                                        <?php echo htmlspecialchars($row['nom']); ?>
                                    </a>
                                </h2>
                                <p class="price" style="font-size: 1.25rem; font-weight: bold; color: #333;">
                                    <?php echo htmlspecialchars($row['prix']); ?> MAD
                                </p>
                                <div class="star-rating" style="font-size: 1.25rem; color: #f5c518;">
                                    ★★★★☆
                                </div>
                            </div>

                            <!-- Modal du produit -->
                            <div class="modal fade" id="productModal<?php echo htmlspecialchars($row['id']); ?>" tabindex="-1" aria-labelledby="productModalLabel<?php echo htmlspecialchars($row['id']); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="productModalLabel<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['nom']); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img src="admin/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['nom']); ?>" class="img-fluid">
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Prix:</strong> <?php echo htmlspecialchars($row['prix']); ?> MAD</p>
                                                    <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
                                                    <p><strong>Quantité:</strong> <?php echo htmlspecialchars($row['quantite']); ?></p>
                                                    <p class="star-rating" style="font-size: 1.25rem; color: #f5c518;">
                                                        ★★★★☆
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="add_to_cart.php" method="post" onsubmit="return checkLogin(this);">
                                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                                <button type="submit" class="btn btn-primary">Ajouter au Panier</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
            } else {
                echo "<p>Aucun produit trouvé.</p>";
            }
            ?>
        </div>
    </div>
</section>
<!-- Le script pour modal d'ajout au panier -->
<script>
  function checkLogin(form) {
    const isUserLoggedIn = <?php echo json_encode($isUserLoggedIn); ?>;
    if (!isUserLoggedIn) {
        // Trouver la modal du produit actuellement ouverte
        const productModalElement = document.querySelector('.modal.fade.show');
        if (productModalElement) {
            // Fermer la modal du produit
            const productModal = bootstrap.Modal.getInstance(productModalElement);
            productModal.hide();
        }

        // Afficher la modal d'alerte pour la connexion
        const loginAlertModal = new bootstrap.Modal(document.getElementById('loginAlertModal'));
        loginAlertModal.show();

        return false; // Empêche l'envoi du formulaire
    }
    return true; // Permet l'envoi du formulaire si l'utilisateur est connecté
  }
</script>
  
<!-- Donation Start -->
<div class="container-fluid donation py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5" style="max-width: 800px;">
            <h5 class="text-uppercase text-primary">Soutien</h5>
            <h1 class="mb-0">Votre contribution aide à transformer les intérieurs</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="donation-item">
                    <img src="img/offer1.png" class="img-fluid w-100" alt="Image">
                    <div class="donation-content d-flex flex-column">
                        <h5 class="text-uppercase text-primary mb-4">Rénovation</h5>
                        <a href="#" class="btn-hover-color display-6 text-white">Aidez-nous</a>
                        <h4 class="text-white mb-4">Améliorer des espaces de vie</h4>
                        <p class="text-white mb-4">Votre contribution permet de rénover des espaces de vie et d'offrir de nouveaux meubles à ceux qui en ont besoin.</p>
                        <div class="donation-btn d-flex align-items-center justify-content-start">
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Faire un Don !</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="donation-item">
                    <img src="img/offer2.png" class="img-fluid w-100" alt="Image">
                    <div class="donation-content d-flex flex-column">
                        <h5 class="text-uppercase text-primary mb-4">Éducation</h5>
                        <a href="#" class="btn-hover-color display-6 text-white">Aidez-nous</a>
                        <h4 class="text-white mb-4">Éducation à la décoration intérieure</h4>
                        <p class="text-white mb-4">Vos dons financent des ateliers et formations pour aider les gens à mieux décorer leur espace avec style et créativité.</p>
                        <div class="donation-btn d-flex align-items-center justify-content-start">
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Faire un Don !</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="donation-item">
                    <img src="img/offer3.png" class="img-fluid w-100" alt="Image">
                    <div class="donation-content d-flex flex-column">
                        <h5 class="text-uppercase text-primary mb-4">Communauté</h5>
                        <a href="#" class="btn-hover-color display-6 text-white">Aidez-nous</a>
                        <h4 class="text-white mb-4">Renforcer les initiatives locales</h4>
                        <p class="text-white mb-4">Votre soutien aide à financer des projets locaux de décoration et de rénovation qui enrichissent notre communauté.</p>
                        <div class="donation-btn d-flex align-items-center justify-content-start">
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Faire un Don !</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-center">
                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Toutes les Contributions</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Donation End -->

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
                    <a href="#"><i class="fas fa-angle-right me-2"></i> Promotions</a>  
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
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="js/main.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<!-- Script pour modal modal de promotion -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var myModal = new bootstrap.Modal(document.getElementById('promotionModal'), {
      keyboard: false
    });
    myModal.show();
  });
</script>

</body>

</html>