<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
?>
<!doctype html>
<html lang="en" translate="no">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>vendor/fortawesome/font-awesome/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/r-2.2.7/sc-2.0.3/sb-1.0.1/datatables.min.css" />

    <link rel="stylesheet" href="<?= base_url(); ?>public/css/main.css">

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

    <title><?= $title; ?></title>

    <style>
        .datatables>tbody>tr {
            background-color: #343a40 !important;
            color: #fff !important;
        }
    </style>
</head>

<body class="bg-pastel">

    <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-poincoin2">
                <ul class="list-group flataja">
                    <li class="list-group-item bg-poincoin2 flataja p-2 pr-3 text-right">
                        <a href="<?= site_url(); ?>profile" class="text-white font-weight-bold">Profile</a>
                    </li>
                    <li class="list-group-item bg-poincoin2 flataja p-2 pr-3 text-right">
                        <a href="<?= site_url(); ?>change_password_user" class="text-white font-weight-bold">Change Password</a>
                    </li>
                    <li class="list-group-item bg-poincoin2 flataja p-2 pr-3 text-right">
                        <a href="<?= site_url(); ?>logout_user" class="text-white font-weight-bold">Logout</a>
                    </li>
                </ul>
            </div>
        </div>

        <nav class="navbar navbar-dark bg-poincoin1 text-white">
            <div class="d-flex flex-wrap w-100 justify-content-between">
                <div class="p-0" style="margin-top: 5px;">
                    <a data-fancybox="pp" href="<?= base_url(); ?>public/img/avatars/avatar_default.png" style="margin-right: 10px;">
                        <img src="<?= base_url(); ?>public/img/avatars/avatar_default.png" alt="PP" class="img-circle" style="width: 30px;">
                    </a>
                    <div id="myQR" class="img-fluid" style="display: none;"></div>
                    <a id="afancy" data-fancybox="gallery" class="myQR" href="">
                        <img id="imgfancy" src="" class="img-fluid " alt="QR CODE" style="max-width: 30px;">
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

    <nav class="navbar fixed-bottom navbar-light bg-poincoin1 text-white pt-0 pb-0 justify-content-between">
        <div>
            <i class="fas fa-copyright"></i> <?= YEAR_APP; ?> Poincoin
        </div>
        <div>
            Version <?= VERSION_APP; ?>
        </div>
    </nav>

    <!-- <nav class="navbar fixed-bottom text-dark bg-faded">
        <ul class="nav navbar-nav navbar-logo mx-auto">
            <li class="nav-item">
                <button type="button" class="btn text-white text-center btn-special flataja" data-toggle="modal" data-target="#menuModal"><i class="fa fa-bars"></i></button>
            </li>
        </ul>
    </nav> -->

    <div class="card mt pt-2 bg-poincoin1 w-100 flataja" style="border: 0px !important;">
        <div class="card-body p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="p-1 text-center">
                    <a href="<?= site_url(); ?>dashboard_user">
                        <img src="<?= base_url(); ?>public/img/home.png" alt="dashboard" style="width: 80px;">
                    </a>
                </div>
                <div class="p-1 text-center">
                    <a href="<?= site_url(); ?>stacking">
                        <img src="<?= base_url(); ?>public/img/bioner_stacking.png" alt="bc" class="img-fluid" style="width: 80px;">
                    </a>
                </div>
                <div class="p-1 text-center">
                    <!-- <a href="<?= site_url(); ?>bioner_marketplace"> -->
                    <a href="javascript:;" onclick="comingSoon('Poincoin Marketplace');">
                        <img src="<?= base_url(); ?>public/img/bioner_marketplace.png" alt="bc" class="img-fluid" style="width: 80px;">
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
            <div class="col-12 p-2 mb-2">&nbsp;</div>
        </div>

    </div>

    <noscript>
        <meta http-equiv="refresh" content="1;url=<?= base_url(); ?>no_js">
    </noscript>



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
    <script src="<?= base_url(); ?>public/js/jquery.qrcode.min.js"></script>
    <script src="<?= base_url(); ?>public/js/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>public/js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/r-2.2.7/sc-2.0.3/sb-1.0.1/datatables.min.js"></script>
    <script>
        $('#myQR').qrcode({
            text: "<?= $this->session->userdata(SESS . 'username'); ?>",
        }).hide();

        let canvasQR = document.getElementById('myQR').firstChild;
        let imgQR = new Image();
        imgQR.src = canvasQR.toDataURL();

        $('#afancy').attr('href', imgQR.src);
        $('#imgfancy').attr('src', imgQR.src);
        $('[data-toggle="tooltip"]').tooltip();

        $('.pointer').hover(function() {
            $('.pointer').toggleClass('active');
        });

        function comingSoon(jenisComingSoon) {
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: `${jenisComingSoon} Akan Segera Hadir`,
                showConfirmButton: false,
                timer: 3000,
            });
        }
    </script>

    <?php $this->load->view('users/' . $vitamin); ?>

</body>

</html>