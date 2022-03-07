<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $("body").on('click', '.toggle-password', function() {
        $(this).toggleClass("bi bi-eye-slash-fill bi-eye-fill");
        var input = $("#pass_log_id");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }

    });
</script>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>assets/admin/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>assets/admin/js/sb-admin-2.min.js"></script>

</body>

</html>