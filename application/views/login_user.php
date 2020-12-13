<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>public/css/login.css">

    <title>Login - Bioner</title>
</head>

<body>
    <video autoplay loop muted poster="<?= base_url(); ?>public/img/logo.png" id="background">
        <source src="<?= base_url(); ?>public/video/video_background_website.mp4" type="video/mp4">
    </video>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="my-5 card-transparent">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="<?= base_url(); ?>public/img/logo.jpeg" alt="LOGO" class="img-fluid" style="width: 200px;">
                        </div>
                        <h5 class="text-center mt-3 text-white">Member Area</h5>
                        <form class="form-signin mt-3">
                            <div class="form-label-group">
                                <input type="text" id="username" class="form-control" placeholder="Email address" required autofocus>
                                <label for="username">Username</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                <label for="inputPassword">Password</label>
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label text-white" for="customCheck1">Remember
                                    password</label>
                            </div>
                            <a href="<?= site_url(); ?>dashboard.html" class="btn btn-lg btn-primary btn-block text-uppercase text-white" type="submit">Sign
                                in</a>
                            <hr class="my-4">
                            <a href="<?= site_url(); ?>forgot.html" class="btn btn-lg btn-google btn-block text-uppercase text-white" type="submit">Forgot Password ?</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url(); ?>vendor/components/jquery/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="<?= base_url(); ?>js/particles.min.js"></script>
    <script src="<?= base_url(); ?>js/particles-app.js"></script>
    <script src="<?= base_url(); ?>vendor/fontawesome-free-5.15.1-web/js/all.min.js"></script>
</body>

</html>