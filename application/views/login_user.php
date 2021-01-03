<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/login.css">
    <link rel="stylesheet" href="<?= base_url(); ?>vendor/fortawesome/font-awesome/css/all.min.css">

    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url(); ?>apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url(); ?>apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url(); ?>apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url(); ?>apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url(); ?>apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url(); ?>apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url(); ?>apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>favicon-16x16.png">
    <link rel="manifest" href="<?= base_url(); ?>manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= base_url(); ?>ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <title>Login - Bioner</title>
</head>

<body>
    <video autoplay loop muted poster="" id="background">
        <source src="<?= base_url(); ?>public/video/video_background_website.mp4" type="video/mp4">
    </video>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="my-5">
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="text-center">
                                <img src="<?= base_url(); ?>public/img/logo.png" alt="LOGO" class="img-fluid" style="width: 200px;">
                            </div>
                            <h5 class="text-center mt-0 text-white">Member Areas</h5>
                        </div>
                        <div class="card-body">

                            <?php
                            if ($this->session->flashdata('signup_success')) {
                            ?>

                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Success!</strong> <?= $this->session->flashdata('signup_success'); ?>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if (validation_errors()) {
                            ?>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Terjadi Kesalahan</strong> <?= validation_errors(); ?>
                                </div>
                            <?php
                            }
                            ?>


                            <form class="form-signin mt-3" action="<?= site_url(); ?>" method="post">
                                <div class="form-label-group">
                                    <input type="text" id="username" name="username" class="form-control btn-flat" placeholder="Username" required autofocus>
                                    <label for="username">Username</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="password" name="password" class="form-control btn-flat" placeholder="Password" autocomplete="new-password" required>
                                    <label for="password">Password</label>
                                </div>

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember" value="on">
                                    <label class="custom-control-label text-white" for="remember">Remember
                                        password</label>
                                </div>
                                <button type="submit" class="btn btn-lg btn-primary btn-block text-uppercase text-white btn-flat">Sign in</button>
                                <hr class="my-4">
                                <a href="<?= site_url(); ?>forgot_user" class="btn btn-sm btn-google btn-block text-uppercase text-white btn-flat" type="submit">Forgot Password ?</a>
                                <a href="<?= site_url(); ?>signup_user" class="btn btn-sm btn-warning btn-block text-uppercase btn-flat" type="submit"><span style="color: red">Didn't Have Account ?</span> <span style="color: black">Sign Up</span></a>
                            </form>
                        </div>
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
</body>

</html>