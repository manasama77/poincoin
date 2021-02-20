<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>
        <?= $title; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style type="text/css">
        a[x-apple-data-detectors] {
            color: inherit !important;
        }

        a {
            color: white;
            text-decoration: none;
        }
    </style>

</head>

<body style="margin: 0; padding: 0;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;">

                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
                    <tr>
                        <td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0;">
                            <img src="<?= base_url('public/img/email_header_trade.png'); ?>" alt="BIONER HEADER" width="300" height="230" style="display: block;" />
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                <tr>
                                    <td style="color: #153643; font-family: Arial, sans-serif; text-align: center;">
                                        <h1 style="font-size: 24px; margin: 0;">Add New Trade - <?= $kode; ?></h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0; text-align:center;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; text-align: left">
                                            <tr>
                                                <td style="width: 170px;">Total Hak Investment</td>
                                                <td style="width: 10px;">:</td>
                                                <td>1 Lot</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 170px;">Nilai Investment</td>
                                                <td style="width: 10px;">:</td>
                                                <td>Rp.<?= number_format('600000', 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 170px;">Biaya Sewa</td>
                                                <td style="width: 10px;">:</td>
                                                <td>Rp.<?= number_format('150000', 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 170px;">Total Transfer</td>
                                                <td style="width: 10px;">:</td>
                                                <td>Rp.<?= number_format('750000', 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 170px;">Profit per Day</td>
                                                <td style="width: 10px;">:</td>
                                                <td>Rp.<?= number_format('3000', 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <ul>
                                                        <li>Nilai Pembukaan Hak Investment adalah sebesar <mark>Rp.600,000</mark></li>
                                                        <li>Biaya Sewa Per Satu Hak Investment adalah Sebesar <mark>Rp.150,000</mark></li>
                                                        <li>Profit Per Hari yang akan diberikan per 1 Lot / Hak Investment Sebesar <mark>Rp.3,000</mark></li>
                                                        <li>Jadwal pembagian profit akan dilakukan oleh server setiap hari pada pukul <mark>00:00</mark></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ee4c50" style="padding: 30px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                <tr>
                                    <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px; padding-top: 0px; padding-bottom: 10px; width: 35px;">
                                        <a href="https://www.bioner-online.com" target="_blank" style="vertical-align: middle;">
                                            <img src="<?= base_url('public/img/globe.png'); ?>" style="width: 30px;">
                                        </a>
                                    </td>
                                    <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px; padding-top: 0px; padding-bottom: 10px; vertical-align: middle;  text-align: left;">
                                        <a href="https://www.bioner-online.com" target="_blank" style="vertical-align: middle; color:white;">
                                            https://bioner.online
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px; padding-top: 0px; padding-bottom: 0px; width: 35px;">
                                        <a href="https://wa.me/6281219869989" target="_blank" style="vertical-align: middle;">
                                            <img src="<?= base_url('public/img/whatsapp.png'); ?>" style="width: 30px;">
                                        </a>
                                    </td>
                                    <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px; padding-top: 0px; padding-bottom: 0px; vertical-align: middle;  text-align: left;">
                                        <a href="https://wa.me/6281219869989" target="_blank" style="vertical-align: middle; color:white;">
                                            Admin Bioner - 081219869989
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>

</html>