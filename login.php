<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>Intérieur Élégant </title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="lib/animate/animate.min.css"/>
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>
<body>
    <section class="vh-100">
        <div class="container-fluid h-custom" style="margin-top: 3%;">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="img/login-pic.png"    class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST" action="login_process.php">
                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form3Example3">Adresse Email</label>
                            <input type="email" name="email" id="form3Example3" class="form-control form-control-lg"
                                   placeholder="Enter a valid email address" required />
                            
                        </div>
                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Password</label>
                            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                                   placeholder="Enter password" required />
                           
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Check
                                </label>
                            </div>
                            <a href="#!" class="text-body">Mot de passe oublie ?</a>
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Se connecter</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Vous n'avez pas un compte? <a href="register.php"
                                class="link-danger">Creer un compte</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal d'erreur pour mot de passe incorrect -->
<div class="modal fade" id="wrongPasswordModal" tabindex="-1" aria-labelledby="wrongPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wrongPasswordModalLabel">Erreur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Mot de passe incorrect.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'erreur pour compte non trouvé -->
<div class="modal fade" id="noAccountModal" tabindex="-1" aria-labelledby="noAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noAccountModalLabel">Erreur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Aucun compte trouvé avec cet email.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');

    if (error === 'wrong_password') {
        const wrongPasswordModal = new bootstrap.Modal(document.getElementById('wrongPasswordModal'));
        wrongPasswordModal.show();
    } else if (error === 'no_account') {
        const noAccountModal = new bootstrap.Modal(document.getElementById('noAccountModal'));
        noAccountModal.show();
    }
});
</script>

</body>
</html>
