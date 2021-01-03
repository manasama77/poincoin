<script>
    let modalReferal = $('#modalReferal');

    $('document').ready(function() {


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
</script>