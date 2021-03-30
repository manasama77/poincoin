<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    // google chart
    google.charts.load('current', {
        'packages': ['corechart', 'bar']
    });
    google.setOnLoadCallback(load_chart_data);

    function load_chart_data() {
        $.ajax({
            url: "<?= site_url(); ?>temp_chart",
            type: "POST",
            dataType: "json",
            async: false
        }).done(function(e) {
            console.log(e);
            drawChart(e.title, e.subtitle, e.data);
        });
    }

    function drawChart(title, subtitle, data) {

        var data = google.visualization.arrayToDataTable(data);

        var options = {
            width: '100%',
            height: 400,
            bar: {
                groupWidth: '75%'
            },
            chart: {
                title: title,
                subtitle: subtitle,
            },
            animation: {
                duration: 1,
                easing: 'linear',
                startup: true
            },
            chartArea: {
                left: 20,
                top: 20,
                width: '50%',
                height: '75%'
            }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }





    let modalReferal = $('#modalReferal');

    $('document').ready(function() {
        // initMarketIDR();
        // setInterval(function() {
        //     initMarketIDR();
        // }, 5000);
    });

    function showModalListReferal(id) {
        modalReferal.modal('show');

    }

    function copyClipboard() {
        /* Get the text field */
        var copyText = document.getElementById("link_referral");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Link Referal Berhasil Dicopy',
            showConfirmButton: false,
            timer: 3000,
        });
    }

    function initMarketIDR() {
        $.ajax({
            url: '<?= base_url(); ?>get_market_idr',
            method: 'get',
            dataType: 'json',
            beforeSend: function() {
                // $.blockUI();
            }
        }).always(function() {
            // $.unblockUI();
        }).fail(function(e) {
            console.log(e);
        }).done(function(e) {
            console.log(e);
            let htmlnya = "";
            let currentTimestamp = new Date();

            if (e.data.length > 0) {
                let no = 1;
                $.each(e.data, function(i, k) {
                    htmlnya += `
                    <tr>
                        <td>${no}</td>
                        <td><img src="${k.url_logo}" style="width: 20px;"> ${k.description}</td>
                        <td>${k.name}</td>
                        <td>${k.last}</td>
                        <td>${k.buy}</td>
                        <td>${k.sell}</td>
                        <td>${k.high}</td>
                        <td>${k.low}</td>
                    </tr>
                    `;
                    no++;
                });


                $('#update_timestamp').html('Last Update' + currentTimestamp.toLocaleString());

                $('#table_idr > tbody').html(htmlnya);
            }
        });
    }

    function formatNumber(n) {
        if (n.indexOf('.') > -1)
            return parseFloat(n).toFixed(8);
        else
            return parseInt(n).toLocaleString("id-ID")
    }
</script>