<?php
session_start();
include 'db_connect.php';
$user_id = $_SESSION['user_id'];
$host = 'localhost'; // ou l'adresse de votre serveur de base de données
$dbname = 'ecomint';
$username = 'root';
$password = 'root123456';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit;
}
if (!$pdo) {
    echo 'Erreur de connexion à la base de données.';
    exit;
}


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$current_name = '';
$current_email = '';

try {
    $stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $current_name = htmlspecialchars($user['name']);
        $current_email = htmlspecialchars($user['email']);
        $_SESSION['user_name'] = $current_name; // Update session data
    }
} catch (PDOException $e) {
    echo 'Erreur lors de la récupération des informations : ' . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = trim($_POST['new_name']);
    $new_password = trim($_POST['new_password']);

    try {
        if (!empty($new_name)) {
            $stmt = $pdo->prepare("UPDATE users SET name = ? WHERE id = ?");
            $stmt->execute([$new_name, $user_id]);
            $_SESSION['user_name'] = $new_name; // Update session data
        }

        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$hashed_password, $user_id]);
        }
    } catch (PDOException $e) {
        echo 'Erreur lors de la mise à jour du profil : ' . $e->getMessage();
        exit;
    }
}
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
                <a href="register.php"><small class="me-3 text-dark"><i class="fas fa-user text-primary me-2"></i>Register</small></a>
                <a href="login.php"><small class="me-3 text-dark"><i class="fas fa-sign-in-alt text-primary me-2"></i>Se connecter</small></a>
                <?php if (isset($_SESSION['user_name'])): ?>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown">
                        <small><i class="fas fa-home text-primary me-2"></i> <?php echo htmlspecialchars($_SESSION['user_name']); ?></small>
                    </a>
                    <div class="dropdown-menu rounded">
                        <a href="#" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> Mon profil</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Panier</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Favoris</a>
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
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                <span class="dropdown-toggle">Categories</span>
                            </a>
                            <div class="dropdown-menu m-0">
                                <a href="feature.html" class="dropdown-item">Categorie 001</a>
                                <a href="team.html" class="dropdown-item">Categorie 002</a>
                                <a href="testimonial.html" class="dropdown-item">Categorie 001</a>
                                <a href="offer.html" class="dropdown-item">Categorie 001</a>
                                <a href="FAQ.html" class="dropdown-item">Categorie 001</a>
                            </div>
                        </div>
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
<div class="container mt-5" style="margin-bottom: 10%;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4">Modifier Mon Profil</h1>
            <form action="" method="post" class="shadow p-4 rounded bg-light">
                <div class="mb-3">
                    <label for="current_name" class="form-label">Nom actuel</label>
                    <input type="text" class="form-control" id="current_name" name="current_name" value="<?php echo $current_name; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="new_name" class="form-label">Nouveau nom</label>
                    <input type="text" class="form-control" id="new_name" name="new_name" placeholder="Entrez votre nouveau nom">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $current_email; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Entrez votre nouveau mot de passe">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg w-100">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="successModalLabel">Succès</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Profil mis à jour avec succès !
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
      <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        var myModal = new bootstrap.Modal(document.getElementById('successModal'));
        myModal.show();
      <?php endif; ?>
    });
    </script>

   
     <!-- Footer Start -->
     <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s" style="background:rgb(27 16 12);">
    <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="footer-item">
                    <a href="index.php" class="p-0">
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
