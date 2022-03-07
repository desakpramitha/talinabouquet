<!-- Start Footer  -->
<footer>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-widget">
                        <h4>About Talina Bouquet</h4>
                        <p>Talina Bouquet based in Denpasar, Bali provides various kinds of snacks and money arrangements for birthday celebrations, graduations, and other special moments.
                            We have wide-range collection of arrangements ranging from bouquets, and snack boxes.
                        </p>
                        <ul>
                            <li><a href="https://www.instagram.com/talinabouquet/"><i class=" fab fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="https://wa.me/081239754384/"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-link">
                        <h4>Information</h4>
                        <ul>
                            <li><a href="<?= base_url() ?>dashboard_controller/faq">FAQ</a></li>
                            <li><a href="<?= base_url() ?>dashboard_controller/how">How to buy</a></li>
                            <li><a href="<?= base_url() ?>dashboard_controller/shipping">Delivery Information</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-link-contact">
                        <h4>Contact Us</h4>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>Address: Jalan Tunjung Sari No 30,<br> Padangsambian, Denpasar, Bali </p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone"></i>Phone: <a href="https://wa.me/081239754384/">+62-81239754384</a></p>
                            </li>
                            <li>
                                <p><i class="fab fa-instagram"></i><a href="https://www.instagram.com/talinabouquet/">talinabouquet</a></p>
                            </li>
                            <li>
                                <p><i class=" fas fa-envelope"></i>Email: <a href="mailto:talinabouquet@gmail.com">talinabouquet@gmail.com</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to leave.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth_controller/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>
</div>

<!-- End Footer  -->

<!-- Start copyright  -->
<div class="footer-copyright">
    <p class="footer-company">Copyright &copy; <?= date('Y'); ?> <a href="#">Talina Bouquet</a></p>
</div>
<!-- End copyright  -->

<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

<!-- ALL JS FILES -->
<script src="<?= base_url(); ?>assets/user/js/jquery-3.2.1.min.js"></script>
<script src="<?= base_url(); ?>assets/user/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/user/js/bootstrap.min.js"></script>
<!-- ALL PLUGINS -->
<script src="<?= base_url(); ?>assets/user/js/jquery.superslides.min.js"></script>
<script src="<?= base_url(); ?>assets/user/js/bootstrap-select.js"></script>
<script src="<?= base_url(); ?>assets/user/js/inewsticker.js"></script>
<script src="<?= base_url(); ?>assets/user/js/bootsnav.js."></script>
<script src="<?= base_url(); ?>assets/user/js/images-loded.min.js"></script>
<script src="<?= base_url(); ?>assets/user/js/isotope.min.js"></script>
<script src="<?= base_url(); ?>assets/user/js/owl.carousel.min.js"></script>
<script src="<?= base_url(); ?>assets/user/js/baguetteBox.min.js"></script>
<script src="<?= base_url(); ?>assets/user/js/jquery-ui.js"></script>
<script src="<?= base_url(); ?>assets/user/js/jquery.nicescroll.min.js"></script>
<script src="<?= base_url(); ?>assets/user/js/form-validator.min.js"></script>
<script src="<?= base_url(); ?>assets/user/js/contact-form-script.js"></script>
<script src="<?= base_url(); ?>assets/user/js/custom.js"></script>


<!-- jquery -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $("#datepicker").datepicker({
            minDate: moment().add('d', 2).toDate(),
        });
    });
</script>
<!-- Page level plugins -->
<script src="<?= base_url(); ?>assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>assets/admin/js/demo/datatables-demo.js"></script>

</body>

</html>