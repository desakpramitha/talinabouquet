<body class="bg-gradient-warning">

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-10">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-7 d-flex justify-content-center">
                                <div class="align-self-center">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                    </div>
                                    <form class="user" method="POST" action="<?= base_url('auth_controller/register'); ?>">
                                        <div class="form-group">
                                            <input type="text" name="name" value="<?= set_value('name'); ?>" class="form-control form-control-user" id="exampleInputEmail" placeholder="Full Name">
                                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" value="<?= set_value('email'); ?>" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" name="repeatPassword" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                                                <?= form_error('repeatPassword', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <button name="submit" class="btn btn-warning btn-user btn-block">
                                            Register Account
                                        </button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small text-secondary" href="<?= base_url(); ?>auth_controller/forgotPassword">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small text-secondary" href="<?= base_url(); ?>auth_controller/index">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 d-none d-lg-block bg-register">
                                <img class="img-fluid" src="<?= base_url(); ?>assets/admin/img/BuketSnack.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>