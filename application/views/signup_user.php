<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>public/css/login.css">

    <title>Sign Up - Bioner</title>
</head>

<body>
    <video autoplay loop muted poster="<?= base_url(); ?>public/img/logo.png" id="background">
        <source src="<?= base_url(); ?>public/video/video_background_website.mp4" type="video/mp4">
    </video>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="my-5">
                    <div class="text-center">
                        <img src="<?= base_url(); ?>public/img/logo.jpeg" alt="LOGO" class="img-fluid" style="width: 200px;">
                    </div>
                    <div class="card card-custom">
                        <div class="card-header">
                            <h5 class="text-center mt-3 text-white">Sign Up Area</h5>
                        </div>
                        <div class="card-body">

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

                            <form class="form-signin mt-3" action="<?= site_url(); ?>register_user" method="post">
                                <div class="form-label-group">
                                    <input type="text" id="nama" name="nama" class="form-control btn-flat" placeholder="Nama" autocomplete="new-password" value="<?= set_value('nama'); ?>" required autofocus>
                                    <label for="nama">Nama</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="email" id="email" name="email" class="form-control btn-flat" placeholder="Email" autocomplete="new-password" value="<?= set_value('email'); ?>" required>
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="username" name="username" class="form-control btn-flat" placeholder="Username" value="<?= set_value('username'); ?>" required>
                                    <label for="username">Username</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="password" id="password" name="password" class="form-control btn-flat" placeholder="Password" autocomplete="new-password" required>
                                    <label for="password">Password</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="password" id="re_password" name="re_password" class="form-control btn-flat" placeholder="Password Confirmation" autocomplete="new-password" required>
                                    <label for="re_password">Password Confirmation</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="id_referal" name="id_referal" class="form-control btn-flat" placeholder="Referal" value="<?= ($this->uri->segment(2)) ? $this->uri->segment(2) : set_value('id_referal'); ?>" <?= ($this->uri->segment(2)) ? 'readonly' : ''; ?>>
                                    <label for="id_referal">Referal</label>
                                </div>

                                <button type="submit" class="btn btn-lg btn-primary btn-block text-uppercase text-white btn-flat">Sign Up</button>
                                <hr class="my-4">
                                <a href="<?= site_url(); ?>/" class="btn btn-sm btn-warning btn-block text-uppercase btn-flat" type="submit"><span style="color: red">Already Have Account ?</span> <span style="color: black">Log In</span></a>
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
    <script src="<?= base_url(); ?>vendor/fontawesome-free-5.15.1-web/js/all.min.js"></script>
</body>

</html>