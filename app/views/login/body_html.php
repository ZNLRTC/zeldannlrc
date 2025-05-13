
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-lg-5">
            <div class="card">
                <div class="card-header pt-4 pb-4 text-center bg-primary">
                    <a href="<?= BASE_URL ?>">
                        <span><img src="<?php echo BASE_URL_ASSETS; ?>/images/logo.png " alt="" height="70" id="login_logo"></span>
                    </a>
                </div>

                <div class="card-body p-4">
                    <div class="text-center w-75 m-auto">
                        <h4 class="text-dark-50 text-center pb-0 fw-bold">Login</h4>
                        <p class="text-muted mb-4">Enter your email address and password.</p>
                    </div>

                    <div class="alert alert-danger d-none" id="login_error" ><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp;  Wrong email or password!</div>
                    <div class="alert alert-danger d-none" id="login_error2" ><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp;  No user found with this email!</div>
                    <div class="alert alert-danger d-none" id="login_error3" ><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp;  Please enter a valid email address!</div>

                    <form method="post" id="login_admin" action="<?php echo BASE_URL?>/login/userLogin">
                            <div class="mb-3">
                            <label for="emailaddress" class="form-label">Email address</label>
                            <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email" name="email">
                        </div>

                        <div class="mb-3">
                            <a href="#modal-forgot-password" data-bs-toggle="modal" data-target="#modal-forgot-password" class="text-muted float-end"><small>Forgot your password?</small></a>
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password">
                                <div class="input-group-text" data-password="false">
                                <i toggle="#password-field" type = "pass1" class=" fas fa-eye white toggle-password"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input"  value="remember-me" id="remember_me" >
                                <label class="form-check-label" for="checkbox-signin">Remember me</label>
                            </div>
                        </div>

                        <div class="mb-3 mb-0 text-center">
                            <button class="btn btn-primary" type="submit"> Log In </button>
                        </div>
                    </form>

                    

                        <div class=" social-login">
                        <a href="#" class="facebook">
                            <span class="icon-facebook mr-3"></span>
                        </a>

                        <a href="#" class="twitter">
                            <span class="icon-twitter mr-3"></span>
                        </a>
                        <a href="#" class="google">
                            <span class="icon-google mr-3"></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="text-muted">Didn't have an account? <a href="<?php echo BASE_URL; ?>guest/register" class="text-muted ms-1"><b>Apply here!</b></a></p>
                </div>
            </div>
        </div>
    </div>
</div> -->

<section id="login-page" data-layout-config='{"darkMode":false}'>
    <div class="container">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 login-side-container">
                    <div class="login-form-container">
                        <div class="text-center mb-5">
                            <h1 class="text-white mb-0 pb-0">Moi!</h1>
                            <p class="text-white mb-5">Sign in with your account</p>
                            <hr class="text-white">
                        </div>
                        <div class="response">
                            <div class="alert alert-danger d-none" id="login_error" ><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp;  Wrong email or password!</div>
                            <div class="alert alert-danger d-none" id="login_error2" ><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp;  No user found with this email!</div>
                            <div class="alert alert-danger d-none" id="login_error3" ><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp;  Please enter a valid email address!</div>
                        </div>
                        <form method="post" id="login_admin" action="<?php echo BASE_URL?>/login/userLogin">
                            <div class="mb-4">
                                <!-- <label for="emailaddress" class="form-label text-white">Email address</label> -->
                                <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email" name="email">
                            </div>

                            <div class="mb-4">
                                <!-- <label for="password" class="form-label text-white">Password</label> -->
                                <div class="input-group input-group-merge password-container position-relative">
                                    <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password">
                                    <i class="fas fa-eye-slash pointer password-toggle-eye"></i>
                                </div>
                            </div>

                            <div class="mb-5">
                                <button class="btn btn-primary w-100" type="submit"> Log In </button>
                            </div>

                            <div class="text-center">
                                <a href="#modal-forgot-password" data-bs-toggle="modal" data-target="#modal-forgot-password" class="text-white"><u>Forgot your password?</u></a>
                                <div class="text-white">
                                    Didn't have an account? <b><a href="<?= BASE_URL . 'guest/register' ?>" class="text-white">Register here</a></b>
                                </div>
                            </div>

                            <!-- <div class="mb-3 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"  value="remember-me" id="remember_me" >
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div> -->

                            
                        </form>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
    
</section>

<!-- Modal -->
<div class="modal fade" id="modal-forgot-password" tabindex="-1" aria-labelledby="forgot-password-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="forgot-password-label">Forgot Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-forgot-password">
                    <div class="form-group">
                        <label class="form-label" for="fp-email">Email:</label>
                        <div class="d-flex justify-content-between">
                            <input type="text" class="form-control me-1" id="fp-email" name="fp-email" placeholder="Please enter your email here.">
                            <button type="submit" class="btn btn-success" data-url=<?= BASE_URL ?>>Request</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>