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
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/main.css">

</head>

<body>
    <div class="container">
        <img src="<?= base_url(); ?>public/img/favicon-96x96.png" width="96px;">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <th>:</th>
                    <td>
                        <?= $arr->row()->nama; ?>
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <th>:</th>
                    <td>
                        <?= $arr->row()->email; ?>
                    </td>
                </tr>
                <tr>
                    <th>No Handphone</th>
                    <th>:</th>
                    <td>
                        <?= $arr->row()->no_hp; ?>
                    </td>
                </tr>
                <tr>
                    <th>Password</th>
                    <th>:</th>
                    <td>
                        <?= $password_polos; ?>
                    </td>
                </tr>
                <tr>
                    <th>PIN Transaksi</th>
                    <th>:</th>
                    <td>
                        <?= $arr->row()->pin; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <h4>Pastikan kamu menjaga informasi akun kamu, jangan sampai data seperti PIN transaksi tersebar dan disalahgunakan</h4>
        <h5>Terima Kasih<br><small>Ini adalah email otomatis, diharapkan jangan membalas email ini.</small></h5>
        <a href="https://bioner.online" target="_blank">https://bioner.online</a><br>
        <a href="https://wa.me/6281219869989" target="_blank">081219869989 - Admin Bioner</a>
    </div>

</body>