<body style="background-color: #D8BFD8;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-7 d-none d-lg-block bg-password"><img class="img-fluid" src="<?= base_url(); ?>assets/admin/img/mb11.jpg" width="550px"></div>
                            <div class="col-lg-5">
                                <div class="p-4 mb-4 mr-4 mt-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4"> Just enter your email address below and we'll send you a link to reset your password!</p>
                                    </div>

                                    <form class="user" action="<?= base_url() ?>auth_controller/forgotPassword" method="post">
                                        <?= $this->session->flashdata('message') ?>
                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control form-control-user" value="<?= set_value('email'); ?>" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            <?= form_error('email', '<div class="text-danger pl-3"><small>', '</small></div>') ?>
                                        </div>
                                        <button type="submit" class="btn btn-user btn-block text-white" style="background-color: #9370DB">
                                            Reset Password
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small  text-secondary" href="<?= base_url(); ?>auth_controller/register">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small  text-secondary" href="<?= base_url(); ?>auth_controller/index">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>