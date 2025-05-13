<body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'> <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">
                            <!-- Logo -->
                            <div class="card-header pt-4 pb-4 text-center bg-primary">
                                <a href="<?= BASE_URL ?>">
                                    <span><img src="<?php echo BASE_URL_ASSETS; ?>/images/logo.png " alt="" height="70" id="login_logo"></span>
                                </a>
                            </div>

                            <div class="card-body p-4">
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Reset Password</h4>
                                </div>

                                <form method="post" id="reset_passrword" action="<?= BASE_URL ?>">
                                    <input type="hidden" name="email" value="<?= $user['email'] ?>">
                                    <div class="form-group mb-3">
                                        <label class="form-label">New Password</label>
                                        <input class="form-control" type="password" name="reset-password" placeholder="Enter new password" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input class="form-control" type="password" name="confirm-reset-password" placeholder="Confirm new password" required disabled>
                                    </div>
                                    <div id="strength_message_0"></div>
                                    <div class="alert alert-warning">
                                        <ul>
                                            <li>Make sure password is 8 characters.</li>
                                            <li>Password must be a combination of uppercase and lowercase letters.</li>
                                            <li>Password must have a number.</li>
                                            <li><b>Important:</b> New password needs to be at least "Good"</li>
                                        </ul>
                                    </div>
                                    <div class="d-flex justify-content-end text-right mt-3">
                                        <button type="submit" class="btn btn-success reset-password-btn" disabled>Save</button>
                                    </div>
                                </form>
                            </div> <!-- end card-body -->
                        </div>

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

        <!-- end page -->



        <footer class="footer footer-alt">All rights reserved</footer>