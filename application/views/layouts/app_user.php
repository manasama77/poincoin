<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>vendor/fortawesome/font-awesome/css/all.min.css">

    <title>Dashboard - Bioner</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Jura:wght@300;400;500;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap');

        html,
        body {
            font-family: 'Jura', sans-serif;
        }

        #background {
            position: fixed;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -100;
            -webkit-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
            background: url('dist/images/bg1.jpg') no-repeat;
            background-size: cover;
        }

        .card-gradient {
            /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#ff9900+0,ff670f+100 */
            background: rgb(255, 153, 0);
            /* Old browsers */
            background: -moz-linear-gradient(top, rgba(255, 153, 0, 1) 0%, rgba(255, 103, 15, 1) 100%);
            /* FF3.6-15 */
            background: -webkit-linear-gradient(top, rgba(255, 153, 0, 1) 0%, rgba(255, 103, 15, 1) 100%);
            /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom, rgba(255, 153, 0, 1) 0%, rgba(255, 103, 15, 1) 100%);
            /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff9900', endColorstr='#ff670f', GradientType=0);
            /* IE6-9 */


            -webkit-box-shadow: 3px 4px 4px 1px rgba(77, 77, 77, 0.8);
            box-shadow: 3px 4px 4px 1px rgba(77, 77, 77, 0.8);


            border: rgba(0, 0, 0, 0);
        }

        .bg-faded {
            /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#45484d+0,000000+100;Black+3D+%231 */
            background: rgb(69, 72, 77);
            /* Old browsers */
            background: -moz-linear-gradient(top, rgba(69, 72, 77, 1) 0%, rgba(0, 0, 0, 1) 100%);
            /* FF3.6-15 */
            background: -webkit-linear-gradient(top, rgba(69, 72, 77, 1) 0%, rgba(0, 0, 0, 1) 100%);
            /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom, rgba(69, 72, 77, 1) 0%, rgba(0, 0, 0, 1) 100%);
            /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#45484d', endColorstr='#000000', GradientType=0);
            /* IE6-9 */

            border-top: rgb(255, 255, 255) 1px solid;
        }

        .btn-special {
            /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#606c88+0,3f4c6b+100;Grey+3D+%232 */
            background: rgb(96, 108, 136);
            /* Old browsers */
            background: -moz-linear-gradient(top, rgba(96, 108, 136, 1) 0%, rgba(63, 76, 107, 1) 100%);
            /* FF3.6-15 */
            background: -webkit-linear-gradient(top, rgba(96, 108, 136, 1) 0%, rgba(63, 76, 107, 1) 100%);
            /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom, rgba(96, 108, 136, 1) 0%, rgba(63, 76, 107, 1) 100%);
            /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#606c88', endColorstr='#3f4c6b', GradientType=0);
            /* IE6-9 */


            border: #fff 1px solid;
        }

        .modal-special {
            background: rgba(0, 0, 0, 0.9) !important;
        }

        .flataja {
            border-radius: 0% !important;
        }

        .fa-gradient {
            /* filter: drop-shadow(5px 4px 1px #0a0b37); */

            /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#eeeeee+0,eeeeee+100;Grey+Flat */
            background: rgb(0, 0, 0);

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .bg-dark {
            background-color: #020419 !important;
        }

        .bg-dark-1 {
            background-color: #6a3506 !important;
        }

        .bg-pastel {
            /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#f9fcf7+0,f5f9f0+100;L+Green+3D */
            background: rgb(249, 252, 247);
            /* Old browsers */
            background: -moz-linear-gradient(top, rgba(249, 252, 247, 1) 0%, rgba(245, 249, 240, 1) 100%);
            /* FF3.6-15 */
            background: -webkit-linear-gradient(top, rgba(249, 252, 247, 1) 0%, rgba(245, 249, 240, 1) 100%);
            /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom, rgba(249, 252, 247, 1) 0%, rgba(245, 249, 240, 1) 100%);
            /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9fcf7', endColorstr='#f5f9f0', GradientType=0);
            /* IE6-9 */
        }

        .f-news {
            font-family: 'Mukta', sans-serif;
        }

        .pointer {
            cursor: pointer;
        }
    </style>
</head>

<body class="text-white bg-pastel">

    <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark">
                <ul class="list-group flataja">
                    <li class="list-group-item bg-dark flataja p-2 pr-3 text-right">
                        <a href="<?= site_url(); ?>change_password" class="text-white font-weight-bold">Change Password</a>
                    </li>
                    <li class="list-group-item bg-dark flataja p-2 pr-3 text-right">
                        <a href="<?= site_url(); ?>logout_user" class="text-white font-weight-bold">Logout</a>
                    </li>
                </ul>
            </div>
        </div>

        <nav class="navbar navbar-dark bg-dark text-white">
            <div class="d-flex flex-wrap w-100 justify-content-between">
                <div class="p-0" style="margin-top: 5px;">
                    <a data-fancybox="pp" href="<?= base_url(); ?>public/img/avatars/avatar_default.png" style="margin-right: 10px;">
                        <img src="<?= base_url(); ?>public/img/avatars/avatar_default.png" alt="PP" class="img-circle" style="width: 30px;">
                    </a>
                    <a data-fancybox="gallery" href="https://www.kaspersky.com/content/en-global/images/repository/isc/2020/9910/a-guide-to-qr-codes-and-how-to-scan-qr-codes-2.png">
                        <img src="https://www.kaspersky.com/content/en-global/images/repository/isc/2020/9910/a-guide-to-qr-codes-and-how-to-scan-qr-codes-2.png" class="img-fluid" alt="QR CODE" style="max-width: 30px;">
                    </a>
                    <span style="font-weight: bold; margin-left: 10px;"> <?= $this->session->userdata(SESS . 'nama'); ?></span>
                </div>
                <div class="p-0">
                    <button class="navbar-toggler flataja" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fas fa-bars text-white"></span>
                    </button>
                </div>
            </div>
        </nav>
    </div>

    <!-- <nav class="navbar fixed-bottom text-dark bg-faded">
        <ul class="nav navbar-nav navbar-logo mx-auto">
            <li class="nav-item">
                <button type="button" class="btn text-white text-center btn-special flataja" data-toggle="modal" data-target="#menuModal"><i class="fa fa-bars"></i></button>
            </li>
        </ul>
    </nav> -->

    <div class="card mt pt-2 bg-dark w-100 flataja" style="border: 0px !important;">
        <div class="card-body p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="p-1 text-center">
                    <a href="<?= site_url(); ?>stacking">
                        <img src="<?= base_url(); ?>public/img/bioner_stacking.png" alt="bc" class="img-fluid" style="width: 100px;">
                    </a>
                </div>
                <div class="p-1 text-center">
                    <a href="<?= site_url(); ?>bioner_trading">
                        <img src="<?= base_url(); ?>public/img/bioner_trading.png" alt="bt" class="img-fluid" style="width: 100px;">
                    </a>
                </div>
                <div class="p-1 text-center">
                    <a href="<?= site_url(); ?>bioner_mining">
                        <img src="<?= base_url(); ?>public/img/bioner_mining.png" alt="bm" class="img-fluid" style="width: 100px;">
                    </a>
                </div>
                <div class="p-1 text-center">
                    <a href="<?= site_url(); ?>bioner_marketplace">
                        <img src="<?= base_url(); ?>public/img/bioner_marketplace.png" alt="bc" class="img-fluid" style="width: 100px;">
                    </a>
                </div>
                <div class="p-1 text-center">
                    <a href="<?= site_url(); ?>bioner_exchange">
                        <img src="<?= base_url(); ?>public/img/bioner_exchange.png" alt="bc" class="img-fluid" style="width: 100px;">
                    </a>
                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid">

        <!-- <div class="row justify-content-center">
            <div class="col-12 mt-3 mb-3 text-right">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#notificationModal">
                    <i class="fas fa-bell fa-fw"></i> <span class="badge badge-light">4</span>
                </button>
            </div>
        </div> -->

        <?php $this->load->view('users/' . $content); ?>

        <div class="row">
            <div class="col-12 p-2 mb-1"></div>
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
    </script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <?php $this->load->view('users/' . $vitamin); ?>

</body>

</html>