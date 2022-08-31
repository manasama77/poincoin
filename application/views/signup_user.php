<!doctype html>
<html lang="en" translate="no">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/bootstrap.min.css">

    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url(); ?>public/img/public/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url(); ?>public/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url(); ?>public/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>public/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url(); ?>public/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url(); ?>public/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url(); ?>public/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url(); ?>public/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>public/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>public/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>public/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>public/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>public/img/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url(); ?>manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= base_url(); ?>public/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="<?= base_url(); ?>public/css/login.css">

    <title>Sign Up - Poincoin</title>
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
                        <img src="<?= base_url(); ?>public/img/logo wide 2.png" alt="LOGO" class="img-fluid" style="width: 400px; margin-bottom: 40px;">
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

                            <form class="form-signin mt-3" action="<?= site_url(); ?>member/signup/<?= $this->uri->segment(2); ?>" method="post">
                                <div class="form-label-group">
                                    <input type="text" id="nama" name="nama" class="form-control btn-flat" placeholder="Nama" value="<?= set_value('nama'); ?>" required autofocus>
                                    <label for="nama">Nama</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="email" id="email" name="email" class="form-control btn-flat" placeholder="Email" value="<?= set_value('email'); ?>" inputmode="email" required>
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="tel" id="no_hp" name="no_hp" class="form-control btn-flat" placeholder="No Handphone" value="<?= set_value('no_hp'); ?>" inputmode="tel" required>
                                    <label for="no_hp">No Handphone</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="password" id="password" name="password" class="form-control btn-flat" placeholder="Password" autocomplete="new-password" minlength="6" maxlength="255" required>
                                    <label for="password">Password</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="password" id="re_password" name="re_password" class="form-control btn-flat" placeholder="Password Confirmation" autocomplete="new-password" minlength="6" maxlength="255" required>
                                    <label for="re_password">Password Confirmation</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="password" id="pin" name="pin" class="form-control btn-flat" placeholder="PIN Transaksi" inputmode="tel" maxlength="6" required>
                                    <label for="pin">PIN Transaksi</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="password" id="re_pin" name="re_pin" class="form-control btn-flat" placeholder="PIN Transaksi Confirmation" inputmode="tel" maxlength="6" required>
                                    <label for="re_pin">PIN Transaksi Confirmation</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="id_referal" name="id_referal" class="form-control btn-flat" placeholder="Referal" value="<?= ($this->uri->segment(3)) ? $this->uri->segment(3) : set_value('id_referal'); ?>" <?= ($this->uri->segment(2)) ? 'readonly' : ''; ?>>
                                    <label for="id_referal">Referal</label>
                                </div>
                                <div class="form-label-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="snk" name="snk" required />
                                        <label class="form-check-label" for="defaultCheck1" style="color: black;">
                                            I Agree with <a href="#" onclick="showSNK();">Terms & Conditions with Trading Risk Notice</a>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-lg btn-primary btn-block text-uppercase text-white btn-flat">Sign Up</button>
                                <hr class="my-4">
                                <a href="<?= site_url(); ?>member/signin" class="btn btn-sm btn-warning btn-block text-uppercase btn-flat">
                                    <span style="color: red">Already Have Account ?</span> <span style="color: black">Log In</span>
                                </a>
                                <a href="<?= site_url(); ?>" class="btn btn-sm btn-info btn-block text-uppercase btn-flat">
                                    <span style="color: black">Back to Landing Page</span>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL SNK -->
    <div class="modal fade" id="modal_snk" tabindex="-1" role="dialog" aria-labelledby="modal_snk_title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="height: 80%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Terms & Conditions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height: 440px; overflow-y: scroll; max-height: calc(100% - 120px);">
                    <?php $this->load->view('snk'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="aggreeSNK();">Agree</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL SNK -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url(); ?>vendor/components/jquery/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="<?= base_url(); ?>vendor/fortawesome/font-awesome/js/all.min.js"></script>

    <script>
        $(document).ready(function() {
            //
        });

        function showSNK() {
            $('#modal_snk').modal('show');

        }

        function aggreeSNK() {
            $('#snk').prop('checked', true);
            $('#modal_snk').modal('hide');
        }
    </script>
</body>

</html>