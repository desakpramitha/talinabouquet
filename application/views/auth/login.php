<body class="bg-gradient-danger">

    <div class="container">

        <!-- Outer Row -->
        <div class="row d-flex justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-7 d-none d-lg-block bg-login"><img class="img-fluid" src="<?= base_url(); ?>assets/admin/img/sb111.jpg" width="550px"></div>
                            <div class="col-lg-5">
                                <div class="p-4 mr-4 mt-5 ">
                                    <h1 class="h4 text-gray-900 mb-3 text-center">Welcome Back!</h1>
                                    <?= $this->session->flashdata('message'); ?>
                                    <!-- <div class="alert alert-warning" role="alert">Congratulation! your account has been create. Please Login !</div> -->
                                    <form class="user" method="POST" action="<?= base_url('auth_controller/index') ?>">
                                        <div class="form-group">
                                            <input type="email" name="email" value="<?= set_value('email') ?>" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>

                                        <div class="form-group rounded">
                                            <div class="input-group rounded">
                                                <input type="password" name="password" class="form-control border-none form-control-user" placeholder="Password" id="pass_log_id">
                                                <div class="input-group-append" style="border-radius: 0px 0px 60px 60px; ">
                                                    <span class="input-group-text text-danger bg-light border-muted bi bi-eye-slash-fill field_icon toggle-password" style="border-radius: 0px 60px 60px 0px; cursor:pointer; font-size:24px" toggle="#password-field"></span>
                                                </div><br>
                                            </div>
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>

                                        <button type="submit" class="btn btn-user btn-block btn-danger text-white ">
                                            Login
                                        </button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small text-secondary" href="<?= base_url(); ?>auth_controller/forgotPassword">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small text-secondary" href="<?= base_url(); ?>auth_controller/register">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small text-secondary" href="<?= base_url(); ?>dashboard_controller">Back to home</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
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