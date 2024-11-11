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
                    <img src="img/login-pic.png"
                         class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method="POST" action="register_process.php">
    <!-- Name input -->
    <div class="form-outline mb-4">
        <h1>Creer Un compte </h1>
    <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Enter votre name" required />
       
    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
    <label class="form-label" for="email">Email address</label>
        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter votre adresse email" required />
       
    </div>

    <!-- Password input -->
    <div class="form-outline mb-3">
    <label class="form-label" for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter password" required />
        
    </div>

    <!-- Register button -->
    <div class="text-center text-lg-start mt-4 pt-2">
        <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Enregistrer</button>
    </div>
</form>

                </div>
            </div>
        </div>
    </section>
</body>
</html>
