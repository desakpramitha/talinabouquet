<!-- Main Content -->
<div class="main-content">
    <!-- Start All Title Box -->
    <div class="all-title-box" style="background-image: url(<?= base_url() ?>assets/img/banner03-unsplash.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $title ?></h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>user/pelanggan_controller">Home</a></li>
                        <li class="breadcrumb-item active text-white"><a href="<?= base_url() ?>user/pelanggan_controller/testimonials">Testimonials</a></li>
                        <li class="breadcrumb-item active text-white"><?= $title ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Services  -->
    <div class="services-box-main">
        <div class="container">

            <div class="contact-form-right">
                <div class="col-md-10">
                    <h2>Add Testimoni</h2>
                    <p>Hi, <b><?= $user['name'] ?></b>. Add testimoni about product of Talina Bouquet on this form.</p>
                </div>
                <?= $this->session->flashdata('message'); ?>
                <form method="post" action="<?= base_url() ?>user/testimoni_pelanggan_controller/AddTestimoni" enctype="multipart/form-data" class="needs-validation" novalidate="">
                    <div class="col-md-10">

                        <input type="hidden" class="form-control" value="<?= $user['user_id'] ?>" name="user_id">
                        <div class="form-group">
                            <textarea class="form-control" name="description" id="description" cols="10" rows="5" placeholder="Your Description"></textarea>
                            <?= form_error('description', '<div class="text-danger">', '</div>') ?>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <label for="image_testimoni">Profile Image</label>
                        <div class="row">
                            <div class="col-sm-4">
                                <img class="img-thumbnail img-fluid" src="<?= base_url() ?>assets/img/no-image.png" id="gambar_load" height="100px" alt="">
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="preview_gambar" accept="image/*" name="image_testimoni">
                                    <?= form_error('image_testimoni', '<div class="text-danger">', '</div>') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10  mt-3">
                        <div class="submit-button d-flex justify-content-end">
                            <button class="btn hvr-hover" id="submit" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview_gambar").change(function() {
        bacaGambar(this);
    })
</script>